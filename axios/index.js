import axios from "axios";
import {AsyncStorage} from 'react-native'
import CodePush from 'react-native-code-push';



let token 
const  _retrieveData = async () => {
    try {
      const value = await AsyncStorage.getItem('token');
      if (value !== null) {
        // We have data!!
        return  value
      }
    } catch (error) {
      // Error retrieving data
    }
  };
  


  const customAxios =  axios.create(  { headers:{authorization:`Bearer 1|eQSmSfIXP69wENQiAv7q2YxtP41hRdrlRW9r3eO0`} }    )

  customAxios.get(`http://192.168.1.65/api/get-policy`  )
  .then(res=>{
    console.log(res.status)
    if(res.status == 401){
      CodePush.restartApp();
    }
  })

  export default customAxios