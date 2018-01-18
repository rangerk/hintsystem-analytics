import React from 'react'
import ReactDOM from 'react-dom'
import $ from 'jquery'


class Guest extends React.Component {
  
  constructor(props) {
    super(props)
    
    this.state = {
    //  value: props.value,

    }
    
    if (sessionStorage.deleting == 1){
      sessionStorage.deleting = 2
    }
    
  }
  
  render() {
    
    return (

        <span></span>
      
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

let guests =  [...document.getElementsByClassName('guest')].map( e => {
  ReactDOM.render( <Guest /* value={ e.innerHTML } */  />, e) 
})