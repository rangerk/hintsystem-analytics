import React from 'react'
import ReactDOM from 'react-dom'
import $ from 'jquery'

class Email extends React.Component {
  
  constructor(props) {
    super(props)
    
    this.state = {
     // value: props.value,

    }
    
  }
  
  render() {
    
    return (

<button ref={r => this.button = r} type="submit" className="btn btn-primary" onClick={this.click} >
  <i className="fa fa-btn fa-refresh"></i>
  <span className="translate">Reset Password</span>
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
  //  alert('hello')
    //this.button.form.submit()
    
  /*  $.ajax({
      url: '/email/',
      type: 'POST',
      data: {
        email: this.button.form.email.value,
        subject: '',
        body: '',
      },
    }).then(r => { */
       /* document.getElementById('email-help').innerHTML = 
        (!r.email && 'No account found with that email address.')
        ||
        (!r.password && 'Email and password do not match. Please try again.')
        || */
        this.button.form.submit()
        
  //  }, r => document.body.innerHTML = r.responseText)
    
    sessionStorage.email = 1
    
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

let emails =  [...document.getElementsByClassName('email')].map( e => {
  ReactDOM.render( <Email /* value={ e.innerHTML } */ />, e) 
})