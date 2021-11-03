import React, { useState , useEffect } from 'react';
import { ScrollView, Text , View , StyleSheet  , ImageBackground , Dimensions, Button, TouchableOpacity  , Animated , Easing, TextInput, Alert } from 'react-native';
import { CommonActions } from '@react-navigation/native';
import axios from 'axios';
import { createNativeStackNavigator } from '@react-navigation/native-stack';






const AppStack = createNativeStackNavigator();



function Create(props){
    const [carObj , setCarObj] = useState({body:''});
    const [loading , setloading] = useState(false);

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
        setloading(true)
        axios.post( 'https://yaqeens.com/api/checkKroka' , carObj).then(res=>{
            if(res.data){
                console.log(res.data)
                setCarObj(k => { return  { ...k , krooka : res.data.krooka == 0 ? 'لا يوجد حوادث' : res.data.krooka + ' حوادث ' }})
            };
            setloading(false)
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

        <Text style={{ fontSize:24 , textAlign:'center' , padding:10 }}> استعلام حوادث </Text>

        <View style={{ margin:15 , display:'flex' , flexDirection:'row-reverse' ,alignItems:'center' }}>
            <Text style={styles.label}>
                رقم اللوحة : 
            </Text>
            <TextInput keyboardType="numeric" maxLength={2} onChangeText={e=> setCarObj(c=>{ return { ...c , tar: e} })} value={carObj.tar || ''} style={{paddingHorizontal:10 , backgroundColor:'white' , padding:10 , flex:1 , marginHorizontal:5 , textAlign:'right' , borderWidth:1}} />           
            <TextInput keyboardType="numeric" maxLength={5} onChangeText={e=> setCarObj(c=>{ return { ...c , number: e} })} value={carObj.number || ''} style={{paddingHorizontal:10 , backgroundColor:'white' , padding:10 , flex:4 , marginHorizontal:5 , textAlign:'right' , borderWidth:1}} />           
        </View>

        <View style={{ margin:15 , display:'flex' , flexDirection:'row-reverse' ,alignItems:'center' }}>
            <Text style={styles.label}>
                رقم التسجيل : 
            </Text>
            <TextInput keyboardType="numeric" maxLength={10} onChangeText={e=> setCarObj(c=>{ return { ...c , reg: e} })} value={carObj.reg || ''} style={{paddingHorizontal:10 , marginHorizontal:5 , backgroundColor:'white' , padding:10 , flex:4 , textAlign:'right' , borderWidth:1}} />           
        </View>

        {
            loading ? <View style={styles.spinnerContener}>
                        <Animated.View style={{ ...styles.spinner , transform: [{rotate: spin} ] }}/>
                        <Text style={{ marginVertical:20 }}>جار التحقق من الحوادث</Text>
                    </View>
                    : ( carObj.krooka && 
                    <View style={{ margin:15 , display:'flex' , flexDirection:'row-reverse' ,alignItems:'center'  }}>
                        <Text style={styles.label}>
                            الحوادث : 
                        </Text>
                            <Text style={{paddingHorizontal:10 , backgroundColor:'white' , padding:10 , flex:4 , marginHorizontal:5 , textAlign:'right' , borderWidth:1}}>
                                {carObj.krooka}
                            </Text>
                    </View> )
        }

        <View style={{ flex:1  , marginVertical:15 , marginBottom:50 }}>
                <Button disabled={!( (carObj.tar &&  carObj.number) || carObj.reg )} title="استعلام" onPress={()=>getKrooka()}/>
        </View>

        </ScrollView>
    )

}


function Checkout(props){

    const [carObj , setCarObj] = useState(props.route.params.carObj || {})

    const spinValue = new Animated.Value(0)







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