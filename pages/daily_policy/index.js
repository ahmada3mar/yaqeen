import React, { useState , useCallback } from 'react';
import { useFocusEffect } from '@react-navigation/native';
import axios from 'axios'
import { ScrollView, Text , View , Image  ,TouchableOpacity, Alert   } from 'react-native';
import Card from './card';
import reload from '../../img/reload.png'






export default function DailyPolicy(props){
    const [data , setData] = useState([])
    const [refresh , setRefresh] = useState(false)

      

         const getData = async ()=> {
          const data =  await axios.get(`https://yaqeens.com/api/get-policy`).catch(err =>  Alert.alert('خطا' , err.toString()))
          setData(data.data)
        }

       const ploicy = data.map(i => <Card price={i.price} created_at={i.created_at} car_name={i.car_name} key={i.id} name={i.name} type={i.type} status={i.status} />)
       
       useFocusEffect(useCallback(()=>{getData()}, [refresh]));


    return <ScrollView style={{ padding:5 }}>
         <View style={{ flex:1  , alignItems:'center' , justifyContent:'space-between'   , flexDirection:'row-reverse', padding:10, height:100 , borderColor:'black' , borderWidth:1 }}>
             <View  style={{ flexDirection:'column' , justifyContent:'flex-end'  }}>
                <Text style={{ fontSize:18  , textAlign:'right' }}>الاســــم : {props.user.name}</Text>
                <Text style={{ fontSize:18  , textAlign:'right'  }}>المنطقة  :  {props.user.branch.name}</Text>
             </View>
            <TouchableOpacity onPress={()=>setRefresh(c=>!c)}>
                <Image style={{ width:50 , height:50}} source={reload} width={50} height={50}/>
            </TouchableOpacity>
        </View>
        {ploicy}
    </ScrollView>

}