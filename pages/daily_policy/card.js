import moment from 'moment';
import 'moment/locale/ar';
import 'moment/locale/en-au';
import React from 'react';
import {ScrollView, StyleSheet, Text, View} from 'react-native';




export default function Card(props){

    const types = {
        1:'خسارة كلية',
        2:'شامل',
        3:'نقل ملكية',
    }
    const typesColor = {
        1:'#fff9b2',
        2:'#b2ffff',
        3:'نقل ملكية',
    }
    const status = {
        1:'مصدرة' ,
        0:'معلقة' ,
        "-1":'مرفوضة' ,
    }
    const statusColor = {
        1:'green' ,
        0:'orange' ,
        "-1":'red' ,
    }

    return <ScrollView >

     <View style={styles.card} >

        <View style={{ flexDirection:'row' , justifyContent:'space-between' }}>
             <View style={styles.container}>
                <Text>
                    التكلفة
                </Text>
                <Text style={styles.data}>
                        {props.price} دينار
                </Text>
            </View>
            <View style={styles.container}>
                <Text>
                    الحالة
                </Text>
                <Text style={{ ...styles.data , color:statusColor[props.status] }}>
                        {status[props.status]}
                </Text>
            </View>
            <View style={styles.container}>
                <Text>
                    المركبة
                </Text>
                <Text style={styles.data }>
                        {props.car_name}
                </Text>
            </View>


            <View style={{ ...styles.type , backgroundColor:typesColor[props.type] }}>
                <Text>{types[props.type]}</Text>
            </View>

        </View>
        <View style={{ flexDirection:'row-reverse' , justifyContent:'space-between' , paddingVertical:10 }}>

<Text style={{ fontWeight:'bold' }}>
الاسم : {props.name}
</Text>
<Text>{moment(props.created_at).locale('ar').fromNow()}</Text>
</View>
    </View>
    </ScrollView>

}

const styles = StyleSheet.create({
    card: {
           width:'100%' ,
        //    height:100,
           borderRadius:5 ,
           justifyContent:'space-between',
        //    alignItems:'center',
           marginVertical:5,
           padding:10,
           borderWidth:2 ,
           backgroundColor:'white'
           
        //    margin:20
       } ,
       type:{
           width:80 ,
           height:80,
           justifyContent:'center',
           alignItems:'center',
           borderWidth:1
       } ,
       data:{
           justifyContent:'center',
           alignContent:'center',
           overflow:'hidden',
           fontWeight:'bold'
       },
       container:{
        //    alignItems:'flex-end',
           padding:10
       }
           }
   )


