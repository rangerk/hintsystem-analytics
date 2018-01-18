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


import './list.js'
import './onoff.js'
import './tags.js'
import './submit.js'
import './clipboard.js'
import './icon.js'
import './activation.js'
import './type.js'
    
import './translate.js'
import './tabs.js'
import './reset.js'
import './logout.js'
import './columns.js'
import './delete.js'
import './create.js'
import './login.js'
import './email.js'
import './accounts.js'

import './settings.js'
import './invite.js'
import './transfer.js'
import './test.js'

import './import.js'
import './icons.js'
import './password.js'
