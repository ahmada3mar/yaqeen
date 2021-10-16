import React, { useState } from 'react';
import { ScrollView, Text , View , StyleSheet , ImageBackground , Dimensions, Button, TouchableOpacity  , Animated , Easing, TextInput, Picker} from 'react-native';
import full_cover from '../../img/full-cover.png'
import RadioButtonRN from 'radio-buttons-react-native';
import { useFocusEffect } from '@react-navigation/native';
import { StackActions } from '@react-navigation/native';
import { CommonActions } from '@react-navigation/native';
import front_id from '../../img/front-card.png'
import back_id from '../../img/back-card.png'
import * as ImagePicker from 'expo-image-picker'
import axios from 'axios';
import * as ImageManipulator from 'expo-image-manipulator';
import { createNativeStackNavigator } from '@react-navigation/native-stack';






const AppStack = createNativeStackNavigator();




function Create(props){
    const [image , setImage] = useState(null)
    const [imageBack , setImageBack] = useState(null)
    const [uploading , setUploading] = useState(null)
    const [dataTosend , setDataTosend] = useState({})
    const [carObj , setCarObj] = useState({})

    const go = ()=>{
        props.navigation.dispatch(
            CommonActions.reset({
                index: 0,
                routes: [
                    { name: 'الرئيسية' }
                ]
            })
        );
        }

    // useFocusEffect(()=>{
    //     console.log(dataTosend)
    // })

    const _handleImagePicked = async pickerResult => {


        if (!pickerResult.cancelled)
		try {
            let manipResult ;

            if(pickerResult.width > 1300){            
                manipResult = await ImageManipulator.manipulateAsync(
                    pickerResult.uri,
                    [{ resize: { width: 1280 , height:804 } }],
                    { }
                )
             }else{
                manipResult = pickerResult ;
             }
            
			setUploading(true)
            setImage(manipResult);
            axFront(manipResult.uri , 'http://192.168.1.63:80/api/test-front');


		} catch (e) {
			console.log(e);
			alert('تعذر التقاط صورة ، حاول مرة اخرى');
		} finally {
			setUploading(false);
		}
	};


    const  _takePhoto = async () => {
		let pickerResult = await ImagePicker.launchCameraAsync({
			allowsEditing: true,
            aspect: [ 3.375 , 2.125]

		});

		_handleImagePicked(pickerResult);
	};

    const  _takePhotoBack = async () => {
		let pickerResult = await ImagePicker.launchCameraAsync({
			allowsEditing: true,
			aspect: [ 3.375 , 2.125]
		});

        if (!pickerResult.cancelled)
        try {

            let manipResult ;

            if(pickerResult.width > 1300){            
                manipResult = await ImageManipulator.manipulateAsync(
                    pickerResult.uri,
                    [{ resize: { width: 1280 , height:804 } }],
                    { }
                )
             }else{
                manipResult = pickerResult ;
             }
             
			setUploading(true)
            setImageBack(manipResult);
            ax(manipResult.uri , 'http://192.168.1.63:80/api/test');



		} catch (e) {
			console.log(e);
			alert('تعذر التقاط صورة ، حاول مرة اخرى');
		} finally {
			setUploading(false);
		}
	};

    const ax = (uri , link)=>{
        const data2 = new FormData()
        data2.append('file', {
                    uri :uri ,
                    type: 'image/jpeg', 
                    name:  "front.jpg"
                        } );

        
        axios.post( link , data2)
        .then(res=>{
            if(res.data[0]){
                setCarObj(c=>{return {...c , body: res.data[0]}})
            }
            if(res.data[1]){
                setCarObj(c=>{return {...c , eng: res.data[1]}})
            }
            console.log(res.data);
        })
    }

    const axFront = (uri , link)=>{
        const data2 = new FormData()
        data2.append('file', {
                    uri :uri ,
                    type: 'image/jpeg', 
                    name:  "front.jpg"
                        } );

        
        axios.post( link , data2)
        .then(res=>{
            let name = res.data.filter(i=> i.type == 'name')
            let number = res.data.filter(i=> i.type == 'number')

            if(name[0]){
                setCarObj(c=>{return {...c , name: name[0].value}})
            }
            
            if(number[0]){
                setCarObj(c=>{return {...c , number: number[0].value}})
            }
            console.log(res.data);
        })
    }


    // Animated.loop(
    //     Animated.timing(
    //      spinValue,
    //       {
    //        toValue: 5,
    //        duration: 3000,
    //        easing: Easing.linear,
    //        useNativeDriver: true
    //       }
    //     )
    //    ).start();



    const data = [
        {
          label: 'ركوب صغير',
          id: '1'
         },
         {
          label: 'شحن',
          id: '2'
         },
         {
          label: 'نقل مشترك',
          id: '3'
         }
        ];
        



    return(
        <ScrollView style={{ padding:5 }}>
            <View style={{ flex:1  , justifyContent:'center' , padding:10, height:80 , borderColor:'black' , borderWidth:1 }}>
                <Text style={{ fontSize:18  }}>الاســــم : احمد عبد السميع</Text>
                <Text style={{ fontSize:18  }}>المنطقة :مــــاركا</Text>

            </View>
            <View style={{ flex:1  , marginVertical:5}}>
                <RadioButtonRN
                    textStyle={{ width:'100%' , textAlign:'right' }}
                    data={data}
                    selectedBtn={(e) => setCarObj(c=>{ return {...c , type:e.label}}) }
                />
            </View>

            <View style={{ flex:1  , marginVertical:5 }}>
                <TouchableOpacity style={{ margin:10 , borderRadius:10  }} onPress={()=>_takePhoto()}>
                   { image ?  <ImageBackground source={{ uri: image.uri }} style={{backgroundColor:'white'  , borderRadius:10  , height:240}}/> : (<ImageBackground source={front_id} style={{backgroundColor:'white'  , borderRadius:10  , height:240}}/>) }
                </TouchableOpacity>

                <TouchableOpacity style={{ margin:10 , borderRadius:10  }} onPress={()=>_takePhotoBack()}>
                   { imageBack ?  <ImageBackground source={{ uri: imageBack.uri }} style={{backgroundColor:'white'  , borderRadius:10  , height:240}}/> : (<ImageBackground source={back_id} style={{backgroundColor:'white'  , borderRadius:10  , height:240}}/>) }
                </TouchableOpacity>
            </View>
  
            <View style={{ flex:1  , marginVertical:15 , marginBottom:50 }}>
                <Button disabled={!(carObj.type && carObj.eng && carObj.body && carObj.name && carObj.number)} title="التــــالي" onPress={()=>props.navigation.navigate({
            name: 'Next',
            params: { carObj: carObj},
          })}/>
            </View>

        </ScrollView>
    )

}

function Next(props){
    const [obj , setObj] = useState(props.route.params.carObj || {})
    const go = ()=>{
        props.navigation.dispatch(
            CommonActions.reset({
                index: 0,
                routes: [
                    { name: 'الرئيسية' }
                ]
            })
        );
        }



    return <ScrollView >
            <View style={{ flex:1  , justifyContent:'center' , padding:10, height:80 , borderColor:'black' , borderWidth:1 }}>
                <Text style={{ fontSize:18  }}>الاســــم : احمد عبد السميع</Text>
                <Text style={{ fontSize:18  }}>المنطقة :مــــاركا</Text>

            </View>
    	<View style={styles.result}>
    <View style={{ margin:5 , display:'flex' , flexDirection:'row-reverse'  }}>
        <Text style={styles.label}>
            الاســم : 
        </Text>
        <TextInput onChangeText={e=> setObj(c=>{ return { ...c , name: e} })} value={obj.name || ''} style={{paddingHorizontal:10 , backgroundColor:'white' , padding:5 , flex:4 , textAlign:'right' , borderWidth:1}} />           

    </View>
    
    <View style={{ margin:5 , display:'flex' , flexDirection:'row-reverse'  }}>
        <Text style={styles.label}>
            رقم اللوحة : 
        </Text>
        <TextInput onChangeText={e=> setObj(c=>{ return { ...c , number: e} })} value={obj.number || ''} style={{paddingHorizontal:10 , backgroundColor:'white' , padding:5 , flex:4 , textAlign:'right' , borderWidth:1}} />           

    </View>
    
    <View style={{ margin:5 , display:'flex' , flexDirection:'row-reverse'  }}>
        <Text style={styles.label}>
            نوع الهيكل : 
        </Text>
        <Picker
        selectedValue={obj.type || ''}
        style={{ height: 50, width: 150 , justifyContent:'flex-end' , alignContent:'flex-end' , alignItems:'flex-end' }}
        onValueChange={(itemValue, itemIndex) => setObj(c=>{ return { ...c , number: itemValue} })}
      >
        <Picker.Item label="ركوب صغير" value="ركوب صغير" />
        <Picker.Item label="شحن" value="شحن" />
        <Picker.Item label="نقل مشترك" value="نقل مشترك" />
      </Picker>

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
            رقم الشاصي : 
        </Text>
        <TextInput onChangeText={e=> setObj(c=>{ return { ...c , body: e} })} value={obj.body || ''} style={{paddingHorizontal:10 , backgroundColor:'white' , padding:5 , flex:4 , textAlign:'right' , borderWidth:1}} />           

    </View>

    <View style={{ margin:5 , display:'flex' , flexDirection:'row-reverse'  }}>
        <Text style={styles.label}>
            رقم المحرك : 
        </Text>
        <TextInput onChangeText={e=> setObj(c=>{ return { ...c , eng: e} })} value={obj.eng || ''} style={{paddingHorizontal:10 , backgroundColor:'white' , padding:5 , flex:4 , textAlign:'right' , borderWidth:1}} />           
    </View>


    
    


</View>
    <View style={{ margin:10 }}>

        <Button  title="التـــالي" onPress={()=> props.navigation.navigate({
                name: 'checkout',
                params: { carObj: obj},
            })} />
    </View>
</ScrollView>

}

function checkout(props){

    const [kroka , setKroka] = useState(null)

    const spinValue = new Animated.Value(0)

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



    useFocusEffect(()=>{
        axios.post( 'http://192.168.1.63/api/checkKroka' , {body:props.route.params.carObj.body})
        .then(res=>{

            console.log(res.data);
            if(res.data.html)
                setKroka(res.data.html == ' لا يوجد نتائج ، الرجاء المحاولة مرة أخرى ' ? 'لا يوجد حوادث ' : res.data.html)
        })
    })
    
    if(!kroka){
        return 	<View style={styles.spinnerContener}>
                    <Animated.View style={{ ...styles.spinner , transform: [{rotate: spin} ] }}/>
                    <Text style={{ marginVertical:20 }}>جار التحقق من الحوادث</Text>
                </View>
    }else{
        return  <ScrollView >
        <View style={{ flex:1  , justifyContent:'center' , padding:10, height:80 , borderColor:'black' , borderWidth:1 }}>
            <Text style={{ fontSize:18  }}>الاســــم : احمد عبد السميع</Text>
            <Text style={{ fontSize:18  }}>المنطقة :مــــاركا</Text>

        </View>
    <View style={styles.result}>
<View style={{ margin:5 , display:'flex' , flexDirection:'row-reverse'  }}>
    <Text style={styles.label}>
        الاســم : 
    </Text>
        <Text style={{paddingHorizontal:10 , backgroundColor:'white' , padding:5 , flex:4 , textAlign:'right' , borderWidth:1}}>
        {props.route.params.carObj.name || ''}
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
        رقم اللوحة : 
    </Text>
        <Text style={{paddingHorizontal:10 , backgroundColor:'white' , padding:5 , flex:4 , textAlign:'right' , borderWidth:1}}>
        {props.route.params.carObj.number || ''}
        </Text>
</View>


<View style={{ margin:5 , display:'flex' , flexDirection:'row-reverse'  }}>
    <Text style={styles.label}>
        الحوادث : 
    </Text>
        <Text style={{paddingHorizontal:10 , backgroundColor:'white' , padding:5 , flex:4 , textAlign:'right' , borderWidth:1}}>
            {kroka}
        </Text>
</View>

<View style={{ margin:5 , display:'flex' , flexDirection:'row-reverse'  }}>
    <Text style={styles.label}>
        التكــلفة : 
    </Text>
        <Text style={{paddingHorizontal:10 , backgroundColor:'white' , padding:5 , flex:4 , textAlign:'right' , borderWidth:1}}>
            98 ديـــنار
        </Text>
</View>

</View>
<View style={{ margin:10 }}>

    <Button   title="التـــالي" onPress={()=> props.navigation.navigate({
            name: 'checkout',
            params: { carObj: props.route.params.carObj},
        })} />
</View>
</ScrollView>
    }
    
}

export default function CreateTotalLoss(props){

  return <AppStack.Navigator initialRouteName="Drawer">
            <AppStack.Screen name="Create" component={Create}   options={{ headerShown: false }}/>
            <AppStack.Screen name="Next" component={Next}  options={{ headerShown: false }}/>
            <AppStack.Screen name="checkout" component={checkout}  options={{ headerShown: false }}/>
        </AppStack.Navigator>
}

const styles = StyleSheet.create({
 card: {
        width:140 ,
        height:100, backgroundColor:'teal' ,
        justifyContent:'center' ,
        alignItems:'center' ,
        borderRadius:5 ,
        margin:2
    },
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
		margin:10 ,
	
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
        }
)