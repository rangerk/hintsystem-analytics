import React from 'react'
import ReactDOM from 'react-dom'
import $ from 'jquery'


class Create extends React.Component {
  
  constructor(props) {
    super(props)
    
    this.state = {
     // value: props.value,

    }
    
  }
  
  render() {
    
    return (
      <button type="submit" className="btn btn-primary" onClick={this.click}>
        <i className="fa fa-btn fa-user"></i><span className="translate">Register</span>
      </button>
      
    )
    
  }
  
  click = e => {
    /*alert('hello')
    app.log({
      value: 'account created'
    })*/
    
    sessionStorage.creating = 1
          /*
    $.ajax({
      url: '/register',
      type: 'POST',
    }).then( r => {

      location.href = "/"
    })
    */
  }
  
}

/*
$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': window.token
  }
})
*/

let creates =  [...document.getElementsByClassName('create')].map( e => {
  ReactDOM.render( <Create /* value={ e.innerHTML } */ />, e) 
})