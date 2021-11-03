import React, { useState , useEffect } from 'react';
import { ScrollView, Text , View , StyleSheet  , ImageBackground , Dimensions, Button, TouchableOpacity  , Animated , Easing, TextInput, Alert } from 'react-native';
import { CommonActions } from '@react-navigation/native';
import back_id from '../../img/back-card.png'
import * as ImagePicker from 'expo-image-picker'
import axios from 'axios';
import * as ImageManipulator from 'expo-image-manipulator';
import { createNativeStackNavigator } from '@react-navigation/native-stack';
import moment from 'moment';






const AppStack = createNativeStackNavigator();



function Create(props){
    const [image , setImage] = useState(null)
    const [carObj , setCarObj] = useState({
        policy_type:'3' ,
        type:'نقل ملكية',
        start_at:moment().format('YYYY/MM/DD'),
        end_at:moment().add(1,'year').format('YYYY/MM/DD'),
        number:'حسب الرخصة',
        car_name:'حسب الرخصة',
        car_model:'حسب الرخصة',
        eng:'حسب الرخصة',
       
        })



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
            
            setImage(manipResult);
            ax(manipResult.uri , 'https://yaqeens.com/api/BackID');


		} catch (e) {
			console.log(e);
			alert('تعذر التقاط صورة ، حاول مرة اخرى');
		} 
	};

    const chooseImg = ()=>{
        Alert.alert('اختر مكان الصورة' , 'يرجى اختيار مكان الرخصة' , [
            {
                text:'الكاميرا' ,
                onPress: ()=> _takePhoto('camera') 
            },
            {
                text:'المعرض' ,
                onPress: ()=>  _takePhoto('gallary') 
            }
        ])
    }

    const  _takePhoto = async (source) => {
        let options = {
			allowsEditing: true,
            aspect: [ 3.375 , 2.125]

		};

        let pickerResult 

            if(source == 'camera'){
                pickerResult = await ImagePicker.launchCameraAsync(options);
            }else{
                pickerResult =  await ImagePicker.launchImageLibraryAsync(options);       
            }
        

		_handleImagePicked(pickerResult);
	};

    const ax = (uri , link)=>{
        const data2 = new FormData()
        data2.append('file', {
                    uri :uri ,
                    type: 'image/jpeg', 
                    name:  "back.jpg"
                        } );

        
        axios.post( link , data2)
        .then(res=>{
            
            setCarObj(c=>{return {...c , body: res.data.body}})
    
            setCarObj(c=>{return {...c , eng: res.data.eng}})
            setCarObj(c=>{return {...c , back_id: res.data.path}})
            
            console.log(res.data);
 
        })
    }




    return(
        <ScrollView style={{ padding:5 }}>
         <View style={{ flex:1  , alignItems:'center' , justifyContent:'space-between'   , flexDirection:'row-reverse', padding:10, height:100 , borderColor:'black' , borderWidth:1 }}>
             <View  style={{ flexDirection:'column' , justifyContent:'flex-end'  }}>
                <Text style={{ fontSize:18   , textAlign:'right' }}>الاســــم : {props.user.name}</Text>
                <Text style={{ fontSize:18   , textAlign:'right' }}>المنطقة  :  {props.user.branch.name}</Text>
             </View>
        </View>

        <Text style={{ fontSize:24 , textAlign:'center' , padding:10 }}> نقل ملكية </Text>

        <View style={{ margin:15 , display:'flex' , flexDirection:'row-reverse' ,alignItems:'center' }}>
            <Text style={styles.label}>
                الاســم الجديد : 
            </Text>
            <TextInput onChangeText={e=> setCarObj(c=>{ return { ...c , name: e} })} value={carObj.name || ''} style={{paddingHorizontal:10 , backgroundColor:'white' , padding:10 , flex:4 , textAlign:'right' , borderWidth:1}} />           
        </View>

        <View style={{ margin:15 , display:'flex' , flexDirection:'row-reverse' ,alignItems:'center' }}>
            <Text style={styles.label}>
                رقم الشاصي : 
            </Text>
            <TextInput onChangeText={e=> setCarObj(c=>{ return { ...c , body: e} })} value={carObj.body || ''} style={{paddingHorizontal:10 , backgroundColor:'white' , padding:10 , flex:4 , textAlign:'right' , borderWidth:1}} />           
        </View>

            <View style={{ flex:1  , marginVertical:5 }}>
                <TouchableOpacity style={{ margin:10 , borderRadius:10  }} onPress={()=>chooseImg()}>
                   { image ?  <ImageBackground source={{ uri: image.uri }} style={{backgroundColor:'white'  , borderRadius:10  , height:240}}/> : (<ImageBackground source={back_id} style={{backgroundColor:'white'  , borderRadius:10  , height:240}}/>) }
                </TouchableOpacity>
            </View>
  
            <View style={{ flex:1  , marginVertical:15 , marginBottom:50 }}>
                <Button disabled={!( carObj.eng &&  carObj.name )} title="التــــالي" onPress={()=>props.navigation.navigate({
            name: 'checkout',
            params: { carObj: carObj},
          })}/>
            </View>

        </ScrollView>
    )

}


function Checkout(props){

    const [carObj , setCarObj] = useState(props.route.params.carObj || {})

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

      const getKrooka = async () => {
        const res = await axios.post( 'https://yaqeens.com/api/checkKroka' , carObj)
        if(res.data){
            console.log(res.data)
            setCarObj(k => { return  { ...k , krooka : res.data.krooka == 0 ? 'لا يوجد حوادث' : res.data.krooka + ' حوادث ', cost:res.data.cost }})
        }
}

     const store = async () => {
        const res = await axios.post( 'https://yaqeens.com/api/store-policy' , carObj)
        console.log(res.data)
        if(res.data.id){
            props.navigation.dispatch(
                CommonActions.reset({
                    index: 0,
                    routes: [
                        { name: 'الرئيسية' }
                    ]
                })
            );
        }else{
            Alert.alert('فشل يرجى المحاولة مرة اخرى')
        }

     }
      useEffect(()=>{
         getKrooka();
      } , [props.navigation]
      );

      
    
    if(!carObj.krooka){
        return 	<View style={styles.spinnerContener}>
                    <Animated.View style={{ ...styles.spinner , transform: [{rotate: spin} ] }}/>
                    <Text style={{ marginVertical:20 }}>جار التحقق من الحوادث</Text>
                </View>
    }else{
        return  <ScrollView >
         <View style={{ flex:1  , alignItems:'center' , justifyContent:'space-between'   , flexDirection:'row-reverse', padding:10, height:100 , borderColor:'black' , borderWidth:1 }}>
             <View  style={{ flexDirection:'column' , justifyContent:'flex-end'  }}>
                <Text style={{ fontSize:18  , textAlign:'right' }}>الاســــم : {props.user.name}</Text>
                <Text style={{ fontSize:18  , textAlign:'right' }}>المنطقة  :  {props.user.branch.name}</Text>
             </View>
        </View>
    <View style={styles.result}>
<View style={{ margin:5 , display:'flex' , flexDirection:'row-reverse'  }}>
    <Text style={styles.label}>
        الاســم الجديد: 
    </Text>
        <Text style={{paddingHorizontal:10 , backgroundColor:'white' , padding:5 , flex:4 , textAlign:'right' , borderWidth:1}}>
        {props.route.params.carObj.name || ''}
        </Text>
</View>

<View style={{ margin:5 , display:'flex' , flexDirection:'row-reverse'  }}>
    <Text style={styles.label}>
        الحوادث : 
    </Text>
        <Text style={{paddingHorizontal:10 , backgroundColor:'white' , padding:5 , flex:4 , textAlign:'right' , borderWidth:1}}>
            {carObj.krooka}
        </Text>
</View>

<View style={{ margin:5 , display:'flex' , flexDirection:'row-reverse'  }}>
    <Text style={styles.label}>
        التكــلفة : 
    </Text>
        <Text style={{paddingHorizontal:10 , backgroundColor:'white' , padding:5 , flex:4 , textAlign:'right' , borderWidth:1}}>
            {carObj.cost || ''} ديـــنار
        </Text>
</View>

</View>
<View style={{ margin:10 }}>

    <Button   title="التـــالي" onPress={()=> store()} />
</View>
</ScrollView>
    }
    
}



export default function CreateTotalLoss(props){

  return <AppStack.Navigator initialRouteName="Drawer">
            <AppStack.Screen name="Create" children={(r)=><Create {...r} user={props.user} />}   options={{ headerShown: false }}/>
            <AppStack.Screen name="checkout" children={(r)=> <Checkout {...r} user={props.user} />}  options={{ headerShown: false }}/>
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
		 	marginLeft:5 ,
			width:80 ,

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