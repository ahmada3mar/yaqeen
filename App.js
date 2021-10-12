import React, { useEffect, useState } from 'react';
import {
	ActivityIndicator,
	Button,
	Image,
	StyleSheet,
	Text,
	ScrollView,
	View,
	TextInput,
	Dimensions,
	Animated,
	Easing,
	Alert
} from 'react-native';
import * as Permissions from 'expo-camera';
import * as ImagePicker from 'expo-image-picker'
import { nanoid } from 'nanoid/non-secure';
import axios from 'axios';
import { Buffer } from 'buffer';
import QueryString from 'qs';
import {DOMParser} from 'react-native-html-parser'




export default function App() {
    const [image , setImage] = useState(null)
    const [uploading , setUploading] = useState(null)
    const [result , setResult] = useState({prediction:[]})
    const [xx , setXX] = useState(null)

    useEffect(()=>{
         Permissions.requestCameraPermissionsAsync();
    } , [])

   const _handleImagePicked = async pickerResult => {
		try {
			setUploading(true)
            setImage(pickerResult);
			ax(pickerResult.uri);

		} catch (e) {
			console.log(e);
			alert('Upload failed, sorry :(');
		} finally {
			setUploading(false);
		}
	};

    const  _takePhoto = async () => {
		let pickerResult = await ImagePicker.launchCameraAsync({
			allowsEditing: true,
			aspect: [4, 3]
		});

		_handleImagePicked(pickerResult);
	};

    const 	pickImage = async () => {
		let pickerResult = await ImagePicker.launchImageLibraryAsync({
			allowsEditing: true,
			aspect: [4, 3]
		});

		_handleImagePicked(pickerResult);
	};

		const ax = (uri)=>{
			const data = new FormData()
			data.append('file', {
						uri :uri ,
						type: 'image/jpeg', 
						name: nanoid() +".jpg"
							} );

			data.append('modelId', 'c574ee82-bdf1-4148-8999-3d69e73849a8');

			  
			let config = {
				formData:data ,
				headers: {
					'Authorization' : 'Basic ' + Buffer.from('1tRGPUl1V0REb263tKFcFZBIQhwXpblb' + ':').toString('base64'),
				},
			  }
			  
			

			axios.post('https://app.nanonets.com/api/v2/OCR/Model/c574ee82-bdf1-4148-8999-3d69e73849a8/LabelUrls/' , data , config)
			.then(res=>{
				console.log(res.data.result);
				setResult(res.data.result[0]);
			})
		// }
		// fetch('http://192.168.20.22/krooka/Search/SearchResultVehicle.aspx?&d=1632000500211&VehNat=1&PlateNoT=15&PlateNo=25634&RegNo=&ShasiNo=&AccDateFromVar=&AccDateToVar=&EngineNo=&VehCat=0&VehType=0&VehStatus=0&VehOwnNameFirst=&VehOwnNameFather=&VehOwnNameGrand=&VehOwnNameFamily=&OwnerType=0&varResp=0')
 		//  .then(data => {console.log(data) ; console.log('jjjjj')});

		//  createProxyMiddleware({
		// 	target: 'http://192.168.20.22',
		// 	changeOrigin: true,
		//   });



		// var config = {
		// 	method: 'get',
		// 	url: 'http://192.168.20.22/krooka/login.aspx?&d=1632004121646&UN=laith&P=0000',
		// 	headers: { 
		// 	  'Cookie': 'ASP.NET_SessionId=10qg5u5bie4eqyy2xml2slvk'
		// 	}
		//   };

		// const parser = new DOMParser();

		
		// var xmlString  = doc.createElement('div');
		// let doc = new DOMParser().parseFromString("<div>dddddd</div>",'text/html')
	
		// setXX(doc)
	
		
		  
		//   axios.get('http://92.253.8.240/portal').then(res=>{
		
		// 	setXX(res.data)
			
		// 				})
		// }) ;

		  
		
		// axios.create(axiosDefaultConfig);

		// fetch('http://192.168.20.22/krooka/login.aspx?&d=1632004121646&UN=dina&P=0000' , {credentials: 'include', })
		// .then(data => {console.log(data) ; console.log('jjjjj')})
		// 		.catch(err=>console.log(err))

	// axios({
	// 	method: 'get',
	// 	headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
	// 	url: '/krooka/Search/SearchResultVehicle.aspx?&d=1632000500211&VehNat=1&PlateNoT=15&PlateNo=25634&RegNo=&ShasiNo=&AccDateFromVar=&AccDateToVar=&EngineNo=&VehCat=0&VehType=0&VehStatus=0&VehOwnNameFirst=&VehOwnNameFather=&VehOwnNameGrand=&VehOwnNameFamily=&OwnerType=0&varResp=0',
	//   }).then(function (response) {
	// 	console.log(response.data);
	//   });
		console.log('r')
	
	}
		const 	spinValue = new Animated.Value(0)

		Animated.loop(
			Animated.timing(
			 spinValue,
			  {
			   toValue: 5,
			   duration: 3000,
			   easing: Easing.linear,
			   useNativeDriver: true
			  }
			)
		   ).start();

		const spin = spinValue.interpolate({
			inputRange: [0, 1],
			outputRange: ['0deg', '360deg']
		  })

		return (
			<View style={styles.container}>
				<ScrollView
					style={styles.container}
					contentContainerStyle={styles.contentContainer}
				>

					<View style={styles.helpContainer}>

						<View style={{ flex:1 , justifyContent:'center' , display:'flex' }}>
							<View style={{ flexDirection:'row' }}>
								<View style={{ margin:10 }}>
									<Button color="teal" onPress={()=>ax()} title=" تصفح المعرض "/>
								</View>

								<View style={{ margin:10 }}>
									<Button color="teal" onPress={()=>_takePhoto()} title=" فتح الكاميرا " />
								</View>
							</View>
						</View>

						{xx ? <Text>{xx}</Text> : null}

					
						
						{image && (<Image source={{ uri: image.uri }} style={{ width: '100%', height: 250  , marginVertical:10 , borderRadius:10}} />)}
						
						{ 
						image &&
						(	result.prediction.length !=0 ? 
								<View style={styles.result}>
									<View style={{ margin:5 , display:'flex' , flexDirection:'row-reverse'  }}>
										<Text style={styles.label}>
											الاســم : 
										</Text>
											<Text style={{paddingHorizontal:10 , backgroundColor:'white' , padding:5 , flex:4 , textAlign:'right' , borderWidth:1}}>
												احمد عبد السميع محمد اعمر
											</Text>
									</View>
									
									<View style={{ margin:5 , display:'flex' , flexDirection:'row-reverse'  }}>
										<Text style={styles.label}>
											رقم اللوحة : 
										</Text>
											<Text style={{paddingHorizontal:10 , backgroundColor:'white' , padding:5 , flex:4 , textAlign:'right' , borderWidth:1}}>
												15-53259
											</Text>
									</View>
									
									<View style={{ margin:5 , display:'flex' , flexDirection:'row-reverse'  }}>
										<Text style={styles.label}>
											نوع الهيكل : 
										</Text>
											<Text style={{paddingHorizontal:10 , backgroundColor:'white' , padding:5 , flex:4 , textAlign:'right' , borderWidth:1}}>
												صالــون
											</Text>
									</View>
									
									<View style={{ margin:5 , display:'flex' , flexDirection:'row-reverse'  }}>
										<Text style={styles.label}>
											نوع المركبة :
										</Text>
											<Text style={{paddingHorizontal:10 , backgroundColor:'white' , padding:5 , flex:4 , textAlign:'right' , borderWidth:1}}>
												هيونداي
											</Text>
									</View>
								
									<View style={{ margin:5 , display:'flex' , flexDirection:'row-reverse'  }}>
										<Text style={styles.label}>
											سنة الصنع :
										</Text>
											<Text style={{paddingHorizontal:10 , backgroundColor:'white' , padding:5 , flex:4 , textAlign:'right' , borderWidth:1}}>
												2015
											</Text>
									</View>
									
									<View style={{ margin:5 , display:'flex' , flexDirection:'row-reverse'  }}>
										<Text style={styles.label}>
											رقم المحرك : 
										</Text>
											<Text style={{paddingHorizontal:10 , backgroundColor:'white' , padding:5 , flex:4 , textAlign:'right' , borderWidth:1}}>
												{result.prediction.filter((i)=> i?.label == 'eng')[0]?.ocr_text || 'N/A'}
											</Text>
									</View>
									
									<View style={{ margin:5 , display:'flex' , flexDirection:'row-reverse'  }}>
										<Text style={styles.label}>
											رقم الشاصي : 
										</Text>
											<Text style={{paddingHorizontal:10 , backgroundColor:'white' , padding:5 , flex:4 , textAlign:'right' , borderWidth:1}}>
											{result.prediction.filter((i)=> i?.label == 'ch')[0]?.ocr_text || 'N/A'}
											</Text>
									</View>
								</View> : 

									<View style={styles.spinnerContener}>
										<Animated.View style={{ ...styles.spinner , transform: [{rotate: spin} ] }}/>
									</View>
								)
					
					}
					
					

							
					</View>

				</ScrollView>
			</View>
		);
	}



// 	_maybeRenderUploadingOverlay = () => {
// 		if (this.state.uploading) {
// 			return (
// 				<View
// 					style={[
// 						StyleSheet.absoluteFill,
// 						{
// 							backgroundColor: 'rgba(0,0,0,0.4)',
// 							alignItems: 'center',
// 							justifyContent: 'center'
// 						}
// 					]}
// 				>
// 					<ActivityIndicator color="#fff" animating size="large" />
// 				</View>
// 			);
// 		}
// 	};











// async function uploadImageAsync(uri) {
// 	const blob = await new Promise((resolve, reject) => {
// 		const xhr = new XMLHttpRequest();
// 		xhr.onload = function() {
// 			resolve(xhr.response);
// 		};
// 		xhr.onerror = function(e) {
// 			console.log(e);
// 			reject(new TypeError('Network request failed'));
// 		};
// 		xhr.responseType = 'blob';
// 		xhr.open('GET', uri, true);
// 		xhr.send(null);
// 	});

// 	const ref = firebase
// 		.storage()
// 		.ref()
// 		.child(nanoid());
// 	const snapshot = await ref.put(blob);

// 	blob.close();

// 	return await snapshot.ref.getDownloadURL();
// }

const styles = StyleSheet.create({
	container: {
		flex: 1,
		backgroundColor: '#fff',
		paddingBottom: 10 ,

	},
	contentContainer: {
	},

	getStartedContainer: {
		alignItems: 'center',
		marginHorizontal: 50
	},

	getStartedText: {
		fontSize: 17,
		color: 'rgba(96,100,109, 1)',
		lineHeight: 24,
		textAlign: 'center'
	},

	helpContainer: {
		display:'flex',
		alignItems: 'center' ,
		minHeight:Dimensions.get('window').height ,
		justifyContent:'center' ,
		padding:10,
		flex:1
	
	} ,

	result : { padding:20  ,
		backgroundColor:'#f7f7f7' , 
		borderRadius:10 ,
		borderColor:'black' ,
		borderWidth:1 ,
		marginHorizontal:10 ,
		width:'100%',
	
		},
		label:{
			textAlign:'right' ,
		 	marginLeft:10 ,
			 width:80
		} ,
		spinnerContener: {
			// display:'flex' ,
			// width:'100%',
			flex:1,
			justifyContent:'center' ,
			// alignSelf:'stretch' ,
			alignItems:'center' ,
			flexDirection:'column' ,
			// paddingVertical:100
			
		
		},
		spinner:{
			height:60,
			width:60,
			borderRadius:50 ,
			borderWidth: 10 ,
			borderColor:'teal',
			borderTopColor:'transparent' ,
			borderLeftColor:'transparent' ,
			
			
		}
		
});
