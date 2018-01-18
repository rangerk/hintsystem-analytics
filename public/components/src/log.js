import React from 'react'
import ReactDOM from 'react-dom'

import 'whatwg-fetch'
import $ from 'jquery'


$.ajaxSetup({
  headers: {
    //'X-CSRF-TOKEN': window.token
    'X-CSRF-TOKEN': sessionStorage.token
  }
})
    
const app = {
  log: (options) => 
    $.ajax({
      //url: '/log',
      url: '/log/account',
      data: {
        value: options.value,
        //created_at: Date.now(),
       // url: location.href,
        snippet_id: options.snippet_id,
       // token: window.token || null,
      }
    }),
  
}

export default app