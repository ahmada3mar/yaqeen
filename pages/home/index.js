import React, { useState , useCallback } from 'react';
import { ScrollView, Text , View , StyleSheet , ImageBackground , Dimensions, TouchableOpacity  } from 'react-native';
import full_cover from '../../img/full-cover.png';
import total_loss from '../../img/total-loss.png';
import owner from '../../img/owner.png';
import acce from '../../img/acce.png';
import { useFocusEffect } from '@react-navigation/native';
import axios from '../../axios'


export default function Home({ navigation }){

    const [data , setData] = useState([])

    const pinding = data.filter(i=> i.status == 0)
    const approve = data.filter(i=> i.status == 1)
    const debit  = approve.reduce((i , x)=> i + x.price , 0)

    const getData = async ()=> {
        const data =  await axios.get(`http://192.168.1.65/api/get-policy`)
        console.log(data.data)
        setData(data.data)
      }



    useFocusEffect(useCallback(()=>{getData()}, [navigation]));

    return(
        <ScrollView style={{ padding:5 }}>
            <View style={{ flex:1  , justifyContent:'center' , padding:10, height:80 , borderColor:'black' , borderWidth:1 }}>
                <Text style={{ fontSize:18 }}>الاســــم : احمد عبد السميع</Text>
                <Text style={{ fontSize:18 }}>المنطقة :مــــاركا</Text>

            </View>
            <ScrollView horizontal={true}>
            <View style={{ ...styles.card , backgroundColor:'green' }}>
                <Text style={{ fontSize:28 , color:'white'}}>
                    البوالص المصدرة
                </Text>
                <Text style={{ fontSize:28 , color:'white'}}>
                    {approve.length}
                </Text>
            </View>
            <View style={{ ...styles.card , backgroundColor:'orange' }}>
                <Text style={{ fontSize:28 , color:'white'}}>
                    البوالص المعلقة
                </Text>
                <Text style={{ fontSize:28 , color:'white'}}>
                    {pinding.length}
                </Text>
            </View>
            <View style={{ ...styles.card , backgroundColor:'#bd3636' }}>
                <Text style={{ fontSize:28 , color:'white'}}>
                    مجموع ذمم اليوم
                </Text>
                <Text style={{ fontSize:28 , color:'white'}}>
                    {debit}
                </Text>
            </View>

        </ScrollView>
            <View style={{ flex:1  , marginVertical:5}}>
                <ImageBackground source={full_cover} style={{ borderWidth:1 , borderColor:'black' , borderRadius:5  , height:250}}/>
                <View style={{ justifyContent:'center' , alignItems:'center',position:'absolute' , bottom:0 , backgroundColor:'#000000c7' , width:'100%' , height:50 }}>
                    <Text style={{ fontSize:26 , fontWeight:'bold' , color:'teal' }}>طلب تأمين شامل</Text>
                </View>
            </View>
            <View style={{ flex:1  , marginVertical:5}}>
                <TouchableOpacity onPress={ () => navigation.navigate('طلب خسارة كلية') }>
                    <ImageBackground source={total_loss} style={{ borderWidth:1 , borderColor:'black' , borderRadius:5  , height:250}}/>
                    <View style={{ justifyContent:'center' , alignItems:'center',position:'absolute' , bottom:0 , backgroundColor:'#000000c7' , width:'100%' , height:50 }}>
                        <Text style={{ fontSize:26 , fontWeight:'bold' , color:'teal' }}>طلب تأمين خسارة كلية</Text>
                    </View>
                </TouchableOpacity >
            </View>
            <View style={{ flex:1  , marginVertical:5}}>
                <ImageBackground  source={owner} style={{ borderWidth:1 , borderColor:'black' , borderRadius:5  , height:250 }}/>
                <View style={{ justifyContent:'center' , alignItems:'center',position:'absolute' , bottom:0 , backgroundColor:'#000000c7' , width:'100%' , height:50 }}>
                    <Text style={{ fontSize:26 , fontWeight:'bold' , color:'teal' }}>نقل ملكية</Text>
                </View>
            </View>
            <View style={{ flex:1  , marginVertical:5}}>
                <ImageBackground source={acce} style={{ borderWidth:1 , borderColor:'black' , borderRadius:5  , height:250}}/>
                <View style={{ justifyContent:'center' , alignItems:'center',position:'absolute' , bottom:0 , backgroundColor:'#000000c7' , width:'100%' , height:50 }}>
                    <Text style={{ fontSize:26 , fontWeight:'bold' , color:'teal' }}>استعلام عن حوادث</Text>
                </View>
            </View>
        </ScrollView>
    )
}

const styles = StyleSheet.create({
 card: {
        // width:140 ,
        padding:15,
        height:100, 
        justifyContent:'center' ,
        alignItems:'center' ,
        borderRadius:5 ,
        margin:2
    }
        }
)