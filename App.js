import * as React from 'react';
import { Button, Text, View } from 'react-native';
import { createDrawerNavigator } from '@react-navigation/drawer';
import { NavigationContainer } from '@react-navigation/native';
import Home from './pages/home';
import CreateTotal_loss from './pages/total_loss/create'
import * as Permissions from 'expo-camera';




function NotificationsScreen({ navigation }) {
  return (
    <View style={{ flex: 1, alignItems: 'center', justifyContent: 'center' }}>
      <Button onPress={() => navigation.goBack()} title="Go back home" />
    </View>
  );
}

const Drawer = createDrawerNavigator();




export default function App() {

  React.useEffect(()=>{
    Permissions.requestCameraPermissionsAsync();
} , [])


  return (
    <NavigationContainer>
      <Drawer.Navigator initialRouteName="Home">
        <Drawer.Screen name="الرئيسية" component={Home} />
        <Drawer.Screen name="طلب خسارة كلية" component={CreateTotal_loss} />
        <Drawer.Screen name="not" component={NotificationsScreen} />
      </Drawer.Navigator>

    </NavigationContainer>
  );
}