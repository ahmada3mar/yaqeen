import * as React from 'react';
import { Button, AsyncStorage , View } from 'react-native';
import { createDrawerNavigator } from '@react-navigation/drawer';
import { NavigationContainer } from '@react-navigation/native';
import Home from './pages/home';
import DailyPolicy from './pages/daily_policy';
import CreateTotal_loss from './pages/total_loss/create'
import * as Permissions from 'expo-camera';
import axios from 'axios';





function Logout(props) {
  axios.get('http://192.168.1.65/logout').then(res => res.data == 'succsess' &&  props.setUser(false)  )
  return null
}

function LoginPage(props) {
 return <View style={{ marginTop:50 }}>
      <Button  title="hhh" onPress={()=>props.login()} />
  </View>
}
const Drawer = createDrawerNavigator();




export default function App() {
  const [user , setUser] = React.useState(null) ;

 const  _storeData = async (token) => {
    try {
      await AsyncStorage.setItem(
        'token',
        token
      );
    } catch (error) {
      // Error saving data
    }
  };


  
  const login = async ()=>{

    const res = await  axios.get(`http://192.168.1.65/api/login?email=${'ahmada3mar@gmail.com'}&password=123456789` )
    console.log(res.data)
    if(res.data[0].id){
      setUser(res.data)
      _storeData(res.data[1])
    }
  }

  React.useEffect( ()=>{
    Permissions.requestCameraPermissionsAsync();

    axios.get(`http://192.168.1.65/api/login`  )
    .then(res=>{
      if(res.data.id){
        setUser(res.data)
      }
    })

} , [])



  if(!user){
    return <LoginPage login={login} />
  }

  return (
    <NavigationContainer>
      <Drawer.Navigator initialRouteName="Home">
        <Drawer.Screen name="الرئيسية" component={Home} />
        <Drawer.Screen name="طلب خسارة كلية" component={CreateTotal_loss} />
        <Drawer.Screen name="طلب شامل" component={CreateTotal_loss} />
        <Drawer.Screen name="البوالص اليومية" children={()=><DailyPolicy user={user} />}  />
        <Drawer.Screen name="جميع البوالص" component={CreateTotal_loss} />
        <Drawer.Screen name="تسجيل خروج"  children={()=><Logout setUser={setUser} />} />
        </Drawer.Navigator>
    </NavigationContainer>
  );
}