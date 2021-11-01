import * as React from 'react';
import { Button , View, TextInput, ImageBackground , Text  , TouchableHighlight} from 'react-native';
import { createDrawerNavigator } from '@react-navigation/drawer';
import { NavigationContainer } from '@react-navigation/native';
import Home from './pages/home';
import DailyPolicy from './pages/daily_policy';
import CreateTotal_loss from './pages/total_loss/create'
import * as Permissions from 'expo-camera';
import logo from './assets/icon.png'
import axios from 'axios';
import AsyncStorage from '@react-native-async-storage/async-storage'





function Logout(props) {
  axios.get('https://yaqeens.com/logout').then(res => {res.data == 'succsess' ;
  AsyncStorage.clear()
  props.setUser(false)
}
   )
  return null
}

function LoginPage(props) {

  const [userName , setUserName] = React.useState("")
  const [password , setPassword] = React.useState("")
  const [err , setErr] = React.useState(false)

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


  const login = async (userName , password)=>{
    const res = await  axios.get(`https://yaqeens.com/api/login?username=${userName}&password=${password}` )
    if(res.data[0].id){
      props.setUser(res.data[0])
      _storeData(res.data[1])
    }else{
      setErr(true)
    }
  }


 return <View style={{ backgroundColor:'#454d55' , height:'100%' , justifyContent:'center' , padding:25 }}>
    <View >
      <ImageBackground style={{ width:150 , height:150 , alignSelf:'center' , marginVertical:15 }} source={logo} />
      <View style={{ marginVertical:15 }}>
        <TextInput onChangeText={setUserName} value={userName} autoCapitalize='none' placeholder="اسم المستحدم" style={{  backgroundColor:'white' , padding:10 , borderRadius:7 , borderColor:'red' , borderWidth: err ? 1 : 0 , height:40 , marginVertical:10 , textAlign:"center"  }} />
        <TextInput textContentType="password" secureTextEntry={true} autoCapitalize='none' onChangeText={setPassword} value={password} placeholder="كلمة المرور" style={{  backgroundColor:'white' , padding:10 , borderRadius:7 ,  borderColor:'red' , borderWidth: err ? 1 : 0 , height:40 , marginVertical:10 , textAlign:'center' }} />
        
        { err &&  <Text style={{ color:'red' , fontWeight:'bold' }}  >كلمة المرور او اسم المستحدم غير صحيحين</Text> }

      </View>
      <TouchableHighlight style={{  alignItems:'center' , backgroundColor:'teal' , padding:10 , borderRadius:7 }}  onPress={()=>login(userName , password)} >
        <Text style={{ color:'white' }}>تسجيل دخول</Text>
      </TouchableHighlight>
    </View>
  </View>
}
const Drawer = createDrawerNavigator();




export default function App() {
  const [user , setUser] = React.useState(null) ;

  axios.interceptors.request.use(
    async config => {
      const token = await AsyncStorage.getItem('token')
      if (token) {
        config.headers.Authorization = "Bearer "+token
      }
      return config
    },
    error => {
      return Promise.reject(error)
    }
  );




  

  React.useEffect( ()=>{
    Permissions.requestCameraPermissionsAsync();

    axios.get(`https://yaqeens.com/api/login`  )
    .then(res=>{
      if(res.data.id){
        setUser(res.data)
      }
    })

} , [])



  if(!user){
    return <LoginPage setUser={setUser} />
  }

  return (
    <NavigationContainer>
      <Drawer.Navigator initialRouteName="Home">
        <Drawer.Screen name="الرئيسية" children={(props)=> <Home {...props} user={user} />} />
        <Drawer.Screen name="طلب خسارة كلية"  children={(props)=> <CreateTotal_loss {...props} user={user} />} />
        <Drawer.Screen name="طلب شامل"  children={(props)=> <CreateTotal_loss {...props} user={user} />} />
        <Drawer.Screen name="البوالص اليومية" children={(props)=><DailyPolicy {...props} user={user} />}  />
        <Drawer.Screen name="جميع البوالص"  children={(props)=> <CreateTotal_loss {...props} user={user} />} />
        <Drawer.Screen name="تسجيل خروج"  children={(props)=><Logout {...props} setUser={setUser} />} />
        </Drawer.Navigator>
    </NavigationContainer>
  );
}