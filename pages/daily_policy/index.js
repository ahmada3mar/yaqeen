import React, { useState , useCallback, useEffect } from 'react';
import { ScrollView, Text , View , Image , AsyncStorage , Dimensions, Button, TouchableOpacity  , Animated , Easing, TextInput, Picker, Alert} from 'react-native';
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
import Card from './card';
import reload from '../../img/reload.png'




export default function DailyPolicy(props){
    const [data , setData] = useState([])
    const [refresh , setRefresh] = useState(false)

    const  _retrieveData = async () => {
        try {
          const value = await AsyncStorage.getItem('token');
          if (value !== null) {
            // We have data!!
            return value
          }
        } catch (error) {
          // Error retrieving data
        }
      };

         const getData = async ()=> {
          const token = await _retrieveData()
          const data =  await axios.get(`http://92.253.102.198/api/get-policy` , { headers:{authorization:`Bearer ${token}`}})
          console.log(data.data)
          setData(data.data)
        }

       const ploicy = data.map(i => <Card created_at={i.created_at} car_name={i.car_name} key={i.id} name={i.name} type={i.type} status={i.status} />)
       
       useFocusEffect(useCallback(()=>{getData()}, [refresh]));


    return <ScrollView style={{ padding:5 }}>
         <View style={{ flex:1  , alignItems:'center' , justifyContent:'space-between'   , flexDirection:'row-reverse', padding:10, height:80 , borderColor:'black' , borderWidth:1 }}>
             <View  style={{ flexDirection:'column' , justifyContent:'flex-end'  }}>
                <Text style={{ fontSize:18  }}>الاســــم : احمد عبد السميع</Text>
                <Text style={{ fontSize:18  }}>المنطقة :مــــاركا</Text>
             </View>
            <TouchableOpacity onPress={()=>setRefresh(c=>!c)}>
                <Image style={{ width:50 , height:50}} source={reload} width={50} height={50}/>
            </TouchableOpacity>
        </View>
        {ploicy}
    </ScrollView>

}