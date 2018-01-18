import React from 'react'
import ReactDOM from 'react-dom'
import $ from 'jquery'
import app from './log.js'

class Logout extends React.Component {
  
  constructor(props) {
    super(props)
    
    this.state = {
      //value: props.value,

    }
    
  }
  
  render() {
    
    return (
      
      
      <a href="#" onClick={this.click}>
        <i className="fa fa-btn fa-sign-out"></i>
        <span className="translate">Logout</span>
      </a>
      
    )
    
  }
  
  click = e => {
   // e.preventDefault()
  //  alert(sessionStorage.token)
    $.ajax({
      url: '/tokens/delete/',
      data: {
        token: sessionStorage.token
      },
    }).then(r => 
   /*   app.log({
        value: 'logout'
      })
    ).then(r => */
      $.ajax({
        url: '/logout'
      })
    ).then(r => 
      location.href = '/'
    )
  }
  
}

/*
$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': window.token
  }
})
*/

let logouts =  [...document.getElementsByClassName('logout')].map( e => {
  ReactDOM.render( <Logout /*value={ e.innerHTML } */ />, e) 
})