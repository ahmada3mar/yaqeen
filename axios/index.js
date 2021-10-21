import axios from "axios";
import { useState } from "react";
import {AsyncStorage} from 'react-native'



const  _retrieveData = async () => {
    
      const value =  AsyncStorage.getItem('token');
      return await value

  };
  
  
    
    
  export default customAxios = axios.create(  { headers:{authorization:`Bearer  ${'jk'}`} }    )