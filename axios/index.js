import axios from "axios";
import {AsyncStorage} from 'react-native'


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

  export default customAxios