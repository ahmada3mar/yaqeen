from os import replace
import numpy as np
import cv2
import pytesseract
import re
import sys
import json

if(len(sys.argv) > 1):
    receved_img = sys.argv[1]
else :
    print('plase add image path first')
    exit()

pytesseract.pytesseract.tesseract_cmd = "C:\\Program Files\\Tesseract-OCR\\tesseract.exe"

imgQ = cv2.imread('E:\\Yaqeen\\public\\model.jpeg')
h,w , c = imgQ.shape

roi = [[(980, 275), (460, 405), 'text', 'both']]
myData = []

orb = cv2.ORB_create(10000)
kp1 , des1 = orb.detectAndCompute(imgQ , None)
imgKp1 = cv2.drawKeypoints(imgQ , kp1 , None)

# cv2.imshow('ddd',imgKp1)

# compare

img = cv2.imread(receved_img,0)
kp2 , des2 = orb.detectAndCompute(img , None)
bf = cv2.BFMatcher(cv2.NORM_HAMMING)
matches = bf.match(des2 , des1)

matches.sort(key= lambda x: x.distance)
good = matches[:int(len(matches) * .1)]
imgMatch = cv2.drawMatches(img,kp2,imgQ,kp1,good,None , flags=2)

# imgMatch = cv2.resize(imgMatch , (700 , 700))
# cv2.imshow('j' , imgMatch)

srcPoint = np.float32([kp2[m.queryIdx].pt for m in good]).reshape(-1,1,2)
dstPoint = np.float32([kp1[m.trainIdx].pt for m in good]).reshape(-1,1,2)

M, _ = cv2.findHomography(srcPoint,dstPoint , cv2.RANSAC , 5.0)

imgScan =  cv2.warpPerspective(img , M , (w,h))


# imgScan = cv2.resize(imgScan , (w//3 ,h//3))

# imgShow = imgScan.copy()

# cv2.imshow('sss' , imgShow)

# imgMask = np.zeros_like(imgShow)

for x,r in enumerate(roi):

        # cv2.rectangle(imgMask , (r[0][0] , r[0][1]) , (r[1][0] , r[1][1]) , (0,255,0) , cv2.FILLED   )

        # imgShow = cv2.addWeighted(imgShow , 0.99 , imgMask , 0.1 , 0)

        # print(str(r))
        # print(str(r[0][1]))
        # print(str(imgScan[76:110]))
        imgCrop = imgScan[r[0][1]:r[1][1] , r[1][0]:r[0][0]]
        # gray = cv2.cvtColor(imgCrop, cv2.COLOR_BGR2GRAY)
        # kernel = np.ones((3,3),np.uint8)
        # gray = cv2.dilate(imgCrop, kernel, iterations = 1)
        gray = cv2.cvtColor(imgCrop, cv2.IMREAD_GRAYSCALE)
        # gray = cv2.threshold(gray,60,255, cv2.THRESH_BINARY)[1]
        # thresh =  cv2.threshold(gray, 0, 255, cv2.THRESH_BINARY + cv2.THRESH_OTSU)[1]
        # gray = cv2.adaptiveThreshold(gray,255,cv2.CO,\
        #         cv2.THRESH_BINARY,15,15)
        gray=cv2.medianBlur(gray,3)

        data = pytesseract. image_to_string(gray , 'eng' , config="--psm 4  -c tessedit_char_blacklist='QIO.'")
        # cv2.imshow(str(x) , gray)

        data = data. replace(' ' , '' )
        data = data. replace('_' , '' )
        # dataList = re.search(r'[^OIQ]{11}[0-9]{6}',data) # split the string
        dataList = re.split(r'\n',data) # split the string
        dataList = {
            'body' : dataList[0] if len(dataList) > 0 else '',
            'eng' : dataList[1] if len(dataList) > 1 else '',
        }
        # resultList = [int(i.strip()) for i in dataList if i != ''] # remove the '' str and convert str to int.
        # print(dataList.group())
        # print(data)
        # # data = dataList.group()
        # print(f'{dataList[0]}')
        # cv2.imshow(str(x) , gray)

        myData.append(data)

# cv2.imshow(str('dddd') , imgShow)
# with open('data.csv' , 'a+') as f:
#     for data in myData:
#         data = data.replace("\n", "+++++")
#         f.write((str(data)+','))
#     f.write('\n')

# cv2.imshow(str('kk') , imgShow)
# print(str(data))
print(json.dumps(dataList))
# cv2.waitKey(0)
exit()

