import React, { useState , useEffect } from 'react';
import { ScrollView, Text , View , StyleSheet , Picker , ImageBackground , Dimensions, Button, TouchableOpacity  , Animated , Easing, TextInput, Alert } from 'react-native';
import RadioButtonRN from 'radio-buttons-react-native';
import { CommonActions } from '@react-navigation/native';
import front_id from '../../img/front-card.png'
import back_id from '../../img/back-card.png'
import * as ImagePicker from 'expo-image-picker'
import axios from 'axios';
import * as ImageManipulator from 'expo-image-manipulator';
import { createNativeStackNavigator } from '@react-navigation/native-stack';
import DatePicker from 'react-native-datepicker'
import moment, { now } from 'moment';
import humanizeDuration from "humanize-duration"
import {cars} from  '../../data/cars'





const AppStack = createNativeStackNavigator();



function Create(props){
    console.log(moment().format('YYYY/MM/DD'))
    const [image , setImage] = useState(null)
    const [start_at , setStartAt] = useState(moment().format('YYYY/MM/DD'))
    const [end_at , setEndAt] = useState(moment().add(1,'year').format('YYYY/MM/DD'))
    const [open , setOpen] = useState(false)
    const [imageBack , setImageBack] = useState(null)
    const [uploading , setUploading] = useState(null)
    const [carObj , setCarObj] = useState({policy_type:'1' , start_at:start_at , end_at:end_at})



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
            axFront(manipResult.uri , 'https://yaqeens.com/api/FrontID');


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
            ax(manipResult.uri , 'https://yaqeens.com/api/BackID');



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
            
            setCarObj(c=>{return {...c , body: res.data.body}})
    
            setCarObj(c=>{return {...c , eng: res.data.eng}})
            setCarObj(c=>{return {...c , back_id: res.data.path}})
            
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
            let path = res.data.filter(i=> i.type == 'path')

            if(name[0]){
                setCarObj(c=>{return {...c , name: name[0].value}})
            }
            
            if(number[0]){
                setCarObj(c=>{return {...c , number: number[0].value}})
            }

            if(path[0]){
                setCarObj(c=>{return {...c , front_id: path[0].value}})
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
         <View style={{ flex:1  , alignItems:'center' , justifyContent:'space-between'   , flexDirection:'row-reverse', padding:10, height:100 , borderColor:'black' , borderWidth:1 }}>
             <View  style={{ flexDirection:'column' , justifyContent:'flex-end'  }}>
                <Text style={{ fontSize:18   , textAlign:'right' }}>الاســــم : {props.user.name}</Text>
                <Text style={{ fontSize:18   , textAlign:'right' }}>المنطقة  :  {props.user.branch.name}</Text>
             </View>
        </View>
            <View style={{ flex:1  , marginVertical:5}}>
                <RadioButtonRN
                    textStyle={{ width:'100%' , textAlign:'right' }}
                    data={data}
                    selectedBtn={(e) => setCarObj(c=>{ return {...c , type:e.label}}) }
                />
            </View>

            <View style={{ flex:1  , marginVertical:5 , display:'flex' , flexDirection:'row-reverse' , backgroundColor:'white' , padding:10 , alignItems:'center'}}>
            <Text style={{ fontSize:18   , textAlign:'right' , flex:1 }}>بداية التأمين</Text>
                <DatePicker
                    style={{width: 200}}
                    date={start_at}
                    mode="date"
                    locale="en-au"
                    placeholder="select date"
                    format="YYYY/MM/DD"
                    minDate="2021/11/01"
                    maxDate="2023/11/01"
                    customStyles={{
                    dateIcon: {
                        position: 'absolute',
                        left: 0,
                        top: 4,
                        marginLeft: 0
                    },
                    dateInput: {
                        marginLeft: 36
                    }
                    // ... You can check the source to find the other keys.
                    }}
                    onDateChange={(date) => {
                        setStartAt(date) ;
                        setCarObj(c=>{ return {...c , start_at:date}})
                    }}
                />
            </View>

            <View style={{ flex:1  , marginVertical:5 , display:'flex' , flexDirection:'row-reverse' , backgroundColor:'white' , padding:10 , alignItems:'center'}}>
            <Text style={{ fontSize:18   , textAlign:'right' , flex:1 }}>نهاية التأمين</Text>
                <DatePicker
                    style={{width: 200}}
                    date={end_at}
                    mode="date"
                    locale="en-au"
                    placeholder="select date"
                    format="YYYY/MM/DD"
                    minDate="2021/11/01"
                    maxDate="2023/11/01"
                    customStyles={{
                    dateIcon: {
                        position: 'absolute',
                        left: 0,
                        top: 4,
                        marginLeft: 0
                    },
                    dateInput: {
                        marginLeft: 36
                    }
                    // ... You can check the source to find the other keys.
                    }}
                    onDateChange={(date) => {
                        setEndAt(date) ;
                        setCarObj(c=>{ return {...c , end_at:date}})
                    } 
                }
                />
            </View>
            <View style={{ flex:1  , marginVertical:5 , display:'flex' , flexDirection:'row-reverse' , backgroundColor:'white' , padding:10 , alignItems:'center'}}>
            <Text style={{ fontSize:18   , textAlign:'right' , flex:1 }}>المدة</Text>
                <Text>
                    {
                        humanizeDuration(new Date(end_at) - new Date(start_at) + 43200000 
                        , { largest: 3 , language:'ar' , units: ["y", "mo" , 'd'] , round: true   })
                    }
                </Text>
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
    const years = [
        1985 ,
        1986 ,
        1987 ,
        1988 ,
        1989 ,
        1990 ,
        1991 ,
        1992 ,
        1993 ,
        1994 ,
        1995 ,
        1996 ,
        1997 ,
        1998 ,
        1999 ,
        2000 ,
        2001 ,
        2002 ,
        2003 ,
        2004 ,
        2005 ,
        2006 ,
        2007 ,
        2008 ,
        2009 ,
        2010 ,
        2011 ,
        2012 ,
        2013 ,
        2014 ,
        2015 ,
        2016 ,
        2017 ,
        2018 ,
        2019 ,
        2020 ,
        2021 ,
        2022 ,
        2023 ,
        2024 ,
    ]

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

        const cars_list =  cars.map( i =>

            <Picker.Item key={i.id} label={i.name} value={i.name}/>
        )


        const years_list =  years.map( i =>

            <Picker.Item key={i} label={`${i}`}  value={i}/>
        )

        const goToCheckout = ()=>{
            if(obj.name && obj.number && obj.body && obj.eng && obj.type && obj.car_name && obj.car_model && obj.start_at && obj.end_at ){

                props.navigation.navigate({
                    name: 'checkout',
                    params: { carObj: obj},
                })
            }else{
                Alert.alert('خطاء' , 'يرجى التأكد من جميع الخانات')
            }
        }

    return <ScrollView >
         <View style={{ flex:1  , alignItems:'center' , justifyContent:'space-between'   , flexDirection:'row-reverse', padding:10, height:100 , borderColor:'black' , borderWidth:1 }}>
             <View  style={{ flexDirection:'column' , justifyContent:'flex-end'  }}>
                <Text style={{ fontSize:18  , textAlign:'right' }}>الاســــم : {props.user.name}</Text>
                <Text style={{ fontSize:18  , textAlign:'right' }}>المنطقة  :  {props.user.branch.name}</Text>
             </View>
        </View>
    	<View style={styles.result}>
    <View style={{ margin:5 , display:'flex' , flexDirection:'row-reverse' ,alignItems:'center' }}>
        <Text style={styles.label}>
            الاســم : 
        </Text>
        <TextInput onChangeText={e=> setObj(c=>{ return { ...c , name: e} })} value={obj.name || ''} style={{paddingHorizontal:10 , backgroundColor:'white' , padding:5 , flex:4 , textAlign:'right' , borderWidth:1}} />           

    </View>
    
    <View style={{ margin:5 , display:'flex' , flexDirection:'row-reverse' ,alignItems:'center' }}>
        <Text style={styles.label}>
            رقم اللوحة : 
        </Text>
        <TextInput onChangeText={e=> setObj(c=>{ return { ...c , number: e} })} value={obj.number || ''} style={{paddingHorizontal:10 , backgroundColor:'white' , padding:5 , flex:4 , textAlign:'right' , borderWidth:1}} />           

    </View>

    
    <View style={{ margin:5 , display:'flex' , flexDirection:'row-reverse' ,alignItems:'center' }}>
        <Text style={styles.label}>
            رقم الشاصي : 
        </Text>
        <TextInput onChangeText={e=> setObj(c=>{ return { ...c , body: e} })} value={obj.body || ''} style={{paddingHorizontal:10 , backgroundColor:'white' , padding:5 , flex:4 , textAlign:'right' , borderWidth:1}} />           

    </View>

    <View style={{ margin:5 , display:'flex' , flexDirection:'row-reverse' ,alignItems:'center' }}>
        <Text style={styles.label}>
            رقم المحرك : 
        </Text>
        <TextInput onChangeText={e=> setObj(c=>{ return { ...c , eng: e} })} value={obj.eng || ''} style={{paddingHorizontal:10 , backgroundColor:'white' , padding:5 , flex:4 , textAlign:'right' , borderWidth:1}} />           
    </View>
    
    <View style={{ margin:5 , display:'flex' , flexDirection:'row-reverse' ,alignItems:'center'  }}>
        <Text style={styles.label}>
            نوع الهيكل : 
        </Text>
        <Picker
        selectedValue={obj.type || ''}
        style={{ height: 50, width: 150 , justifyContent:'flex-end' , alignContent:'flex-end' , alignItems:'flex-end' }}
        onValueChange={(itemValue, itemIndex) => setObj(c=>{ return { ...c , type: itemValue} })}
      >
        <Picker.Item label="ركوب صغير" value="ركوب صغير" />
        <Picker.Item label="شحن" value="شحن" />
        <Picker.Item label="نقل مشترك" value="نقل مشترك" />
      </Picker>

    </View>
    
    <View style={{ margin:5 , display:'flex' , flexDirection:'row-reverse' ,alignItems:'center' }}>
        <Text style={styles.label}>
            نوع المركبة :
        </Text>
            <Picker
            selectedValue={obj.type || ''}
            style={{ height: 50, width: 150 , justifyContent:'flex-end' , alignContent:'flex-end' , alignItems:'flex-end' }}
            onValueChange={(itemValue, itemIndex) => setObj(c=>{ return { ...c , car_name: itemValue} })}
        >
            <Picker.Item key={0} label={'اختر ....'} value={""}/>

            {cars_list}

        </Picker>
    </View>
    <View style={{ margin:5 , display:'flex' , flexDirection:'row-reverse' ,alignItems:'center' }}>
        <Text style={styles.label}>
            سنة الصنع :
        </Text>
        <Picker
            selectedValue={obj.type || ''}
            style={{ height: 50, width: 150 , justifyContent:'flex-end' , alignContent:'flex-end' , alignItems:'flex-end' }}
            onValueChange={(itemValue, itemIndex) => setObj(c=>{ return { ...c , car_model: itemValue} })}
        >
            <Picker.Item key={0} label={'اختر ....'} value={""}/>
            {years_list}

        </Picker>
    </View>

    <View style={{ flex:1  , marginVertical:5 , display:'flex' , flexDirection:'row-reverse' , backgroundColor:'white' , paddingHorizontal:10 , paddingVertical:5 , alignItems:'center'}}>
            <Text style={{ textAlign:'right' , flex:1 }}>بداية التأمين</Text>
                <DatePicker
                    style={{width: 200}}
                    date={obj.start_at}
                    mode="date"
                    locale="en-au"
                    placeholder="select date"
                    format="YYYY/MM/DD"
                    minDate="2021/11/01"
                    maxDate="2023/11/01"
                    customStyles={{
                    dateIcon: {
                        position: 'absolute',
                        left: 0,
                        top: 4,
                        marginLeft: 0
                    },
                    dateInput: {
                        marginLeft: 36
                    }
                    // ... You can check the source to find the other keys.
                    }}
                    onDateChange={(date) => {
                        setObj(c=>{ return {...c , start_at:date}})
                    }}
                />
            </View>

            <View style={{ flex:1  , marginVertical:5 , display:'flex' , flexDirection:'row-reverse' , backgroundColor:'white' , paddingHorizontal:10 , paddingVertical:5 , alignItems:'center'}}>
            <Text style={{  textAlign:'right' , flex:1 }}>نهاية التأمين</Text>
                <DatePicker
                    style={{width: 200}}
                    date={obj.end_at}
                    mode="date"
                    locale="en-au"
                    placeholder="select date"
                    format="YYYY/MM/DD"
                    minDate="2021/11/01"
                    maxDate="2023/11/01"
                    customStyles={{
                    dateIcon: {
                        position: 'absolute',
                        left: 0,
                        top: 4,
                        marginLeft: 0
                    },
                    dateInput: {
                        marginLeft: 36
                    }
                    // ... You can check the source to find the other keys.
                    }}
                    onDateChange={(date) => {
                        setObj(c=>{ return {...c , end_at:date}})
                    } 
                }
                />
            </View>

            <View style={{ flex:1  , marginVertical:5 , display:'flex' , flexDirection:'row-reverse' , backgroundColor:'white' , paddingHorizontal:10 , paddingVertical:5 , alignItems:'center'}}>
            <Text style={{  textAlign:'right' , flex:1 }}>مدة التأمين</Text>
                <Text>
                    {
                        humanizeDuration(new Date(obj.end_at) - new Date(obj.start_at) + 43200000 
                        , { largest: 3 , language:'ar' , units: ["y", "mo" , 'd'] , round: true   })
                    }
                </Text>
            </View>

    
    


</View>
    <View style={{ margin:10 }}>

        <Button  title="التـــالي" onPress={()=> goToCheckout()} />
    </View>
</ScrollView>

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
        const res = await axios.post( 'https://yaqeens.com/api/checkKroka' , {car:carObj})
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

      

    // useFocusEffect(React.useCallback(() => {
    //     axios.post( 'https://yaqeens.com/api/checkKroka' , {body:carObj.body})
    //     .then(res=>{
  
    //         console.log(res.data);
    //         if(res.data.html)
    //         setCarObj(k => { return  { ...k , krooka :  res.data.html == ' لا يوجد نتائج ، الرجاء المحاولة مرة أخرى ' ? 'لا يوجد حوادث ' : res.data.html }})
    //     })
    //         }, [])
    //     )

    
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
            {props.route.params.carObj.car_name || ''}       
        </Text>
</View>

<View style={{ margin:5 , display:'flex' , flexDirection:'row-reverse'  }}>
    <Text style={styles.label}>
        سنة الصنع :
    </Text>
        <Text style={{paddingHorizontal:10 , backgroundColor:'white' , padding:5 , flex:4 , textAlign:'right' , borderWidth:1}}>
        {props.route.params.carObj.car_model || ''}
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

<View style={{ margin:5 , display:'flex' , flexDirection:'row-reverse'  }}>
    <Text style={styles.label}>
        المدة : 
    </Text>
        <Text style={{paddingHorizontal:10 , backgroundColor:'white' , padding:5 , flex:4 , textAlign:'right' , borderWidth:1}}>
            {
                humanizeDuration(new Date(carObj.end_at) - new Date(carObj.start_at) + 43200000 
                 , { largest: 3 , language:'ar' , units: ["y", "mo" , 'd'] , round: true   })
            }
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
            <AppStack.Screen name="Next" children={(r)=> <Next {...r} user={props.user} />}  options={{ headerShown: false }}/>
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
		 	marginLeft:10 ,
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