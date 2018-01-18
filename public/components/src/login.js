import React from 'react'
import ReactDOM from 'react-dom'
import $ from 'jquery'

class Login extends React.Component {
  
  constructor(props) {
    super(props)
    
    this.state = {
     // value: props.value,

    }
    
  }
  
  render() {
    
    return (
      
      <button ref={r => this.button = r} /* type="submit" */ /* type="button" */ className="btn btn-primary" onClick={this.click} >
        <i className="fa fa-btn fa-sign-in"></i><span className="translate">Login</span>
      </button>
      
    )
    
  }
  
  click = e => {
    e.preventDefault()
    e.stopPropagation()
    /*alert('hello')
    app.log({
      value: 'account created'
    })*/
    //if (e.target.form.email.value){
   //   alert(this.button.form.email.value)
    //}
   // alert(location.href)
 /*   $.ajax({
      url: '/api/login',
      type: 'POST',
      data: {
        email: this.button.form.email.value,
        password: this.button.form.password.value
      }
    }) */
    
    $.ajax({
      url: '/account/validate',
      data: {
        email: this.button.form.email.value,
        password: this.button.form.password.value,
      },
    }).then(r => {
        document.getElementById('email-help').style.position = 'absolute'
        document.getElementById('email-help').style.transition = 'opacity 1s'
        document.getElementById('email-help').style.opacity = 1
        document.getElementById('email-help').innerHTML = 
        (!r.email && 'No account found with that email address.')
        ||
        (!r.password && 'Email and password do not match. Please try again.')
        || 
        this.button.form.submit()
        
        setTimeout(() => document.getElementById('email-help').style.opacity = '0',
                   1000)
        
    }, r => document.body.innerHTML = r.responseText)
  
    sessionStorage.login = 1
    
  //  this.button.form.submit()
  //  e.target.submit()
    
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

let logins =  [...document.getElementsByClassName('login')].map( e => {
  ReactDOM.render( <Login /* value={ e.innerHTML } */ />, e) 
})