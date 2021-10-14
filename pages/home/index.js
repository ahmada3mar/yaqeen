import React, { useEffect } from 'react';
import { ScrollView, Text , View , StyleSheet , ImageBackground , Dimensions } from 'react-native';
import full_cover from '../../img/full-cover.png'


export default function Home(){


    return(
        <ScrollView style={{ padding:5 }}>
            <View style={{ flex:1  , justifyContent:'center' , padding:10, height:80 , borderColor:'black' , borderWidth:1 }}>
                <Text style={{ fontSize:18 }}>الاســــم : احمد عبد السميع</Text>
                <Text style={{ fontSize:18 }}>المنطقة :مــــاركا</Text>

            </View>
            <ScrollView horizontal={true}>
            <View style={styles.card}>
                <Text style={{ fontSize:28 , color:'white'}}>
                    الذمم
                </Text>
                <Text style={{ fontSize:28 , color:'white'}}>
                    190
                </Text>
            </View>
            <View style={styles.card}>
                <Text style={{ fontSize:28 , color:'white'}}>
                    الذمم
                </Text>
                <Text style={{ fontSize:28 , color:'white'}}>
                    190
                </Text>
            </View>
            <View style={styles.card}>
                <Text style={{ fontSize:28 , color:'white'}}>
                    الذمم
                </Text>
                <Text style={{ fontSize:28 , color:'white'}}>
                    190
                </Text>
            </View>
            <View style={styles.card}>
                <Text style={{ fontSize:28 , color:'white'}}>
                    الذمم
                </Text>
                <Text style={{ fontSize:28 , color:'white'}}>
                    190
                </Text>
            </View>
        </ScrollView>
            <View style={{ flex:1  , marginVertical:5}}>
                <ImageBackground source={full_cover} style={{ borderWidth:1 , borderColor:'black' , borderRadius:5  , height:250}}/>
                <View style={{ justifyContent:'center' , alignItems:'center',position:'absolute' , bottom:0 , backgroundColor:'#ffffff91' , width:'100%' , height:50 }}>
                    <Text style={{ fontSize:26 , fontWeight:'bold' , color:'teal' }}>طلب تأمين شامل</Text>
                </View>
            </View>
            <View style={{ flex:1  , marginVertical:5}}>
                <ImageBackground source={full_cover} style={{ borderWidth:1 , borderColor:'black' , borderRadius:5  , height:250}}/>
                <View style={{ justifyContent:'center' , alignItems:'center',position:'absolute' , bottom:0 , backgroundColor:'#ffffff91' , width:'100%' , height:50 }}>
                    <Text style={{ fontSize:26 , fontWeight:'bold' , color:'teal' }}>طلب تأمين شامل</Text>
                </View>
            </View>
            <View style={{ flex:1  , marginVertical:5}}>
                <ImageBackground source={full_cover} style={{ borderWidth:1 , borderColor:'black' , borderRadius:5  , height:250}}/>
                <View style={{ justifyContent:'center' , alignItems:'center',position:'absolute' , bottom:0 , backgroundColor:'#ffffff91' , width:'100%' , height:50 }}>
                    <Text style={{ fontSize:26 , fontWeight:'bold' , color:'teal' }}>طلب تأمين شامل</Text>
                </View>
            </View>
            <View style={{ flex:1  , marginVertical:5}}>
                <ImageBackground source={full_cover} style={{ borderWidth:1 , borderColor:'black' , borderRadius:5  , height:250}}/>
                <View style={{ justifyContent:'center' , alignItems:'center',position:'absolute' , bottom:0 , backgroundColor:'#ffffff91' , width:'100%' , height:50 }}>
                    <Text style={{ fontSize:26 , fontWeight:'bold' , color:'teal' }}>طلب تأمين شامل</Text>
                </View>
            </View>
            <View style={{ flex:1  , marginVertical:5}}>
                <ImageBackground source={full_cover} style={{ borderWidth:1 , borderColor:'black' , borderRadius:5  , height:250}}/>
                <View style={{ justifyContent:'center' , alignItems:'center',position:'absolute' , bottom:0 , backgroundColor:'#ffffff91' , width:'100%' , height:50 }}>
                    <Text style={{ fontSize:26 , fontWeight:'bold' , color:'teal' }}>طلب تأمين شامل</Text>
                </View>
            </View>
        </ScrollView>
    )
}

const styles = StyleSheet.create({
 card: {
        width:140 ,
        height:100, backgroundColor:'teal' ,
        justifyContent:'center' ,
        alignItems:'center' ,
        borderRadius:5 ,
        margin:2
    }
        }
)