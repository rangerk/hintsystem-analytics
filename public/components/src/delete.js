import React from 'react'
import ReactDOM from 'react-dom'
import $ from 'jquery'
import app from './log.js'

class Delete extends React.Component {
  
  constructor(props) {
    super(props)
    
    this.state = {
      value: props.value,
      accounts: [],
      user: {
        email: ''
      },
      text: '',
      email: '',
      step: 'one'
    }
    
  }
  
  componentDidMount(){
    $.ajax({
      url: '/api/accounts'
    }).then(r => {
      this.setState({ accounts: r.accounts })
      return $.ajax({
        url: '/account/user'
      })
    }).then(r => {
      this.setState({ user: r })
    })
  }
  
  render() {
    
    return (
      <div>
      
      <div className="dropdown">
        <button className="btn btn-default dropdown-toggle" 
                data-toggle="dropdown" type="button" ref={r => this.button = r} >
          <i className="fa fa-repeat text-muted"></i> Remove
        </button>
        &nbsp;
        
        <ul className="dropdown-menu">
          <li className="dropdown-header">
      
            { this.state.step == 'one' &&
            <div>
            You are the owner of accounts
            &nbsp;
            {this.state.accounts.map(e => e.nickname).join(' and ')}.
            <br />
            Do you want to transfer ownership
            to save those accounts ?
            <br /><br />
            <button type="button" className="btn btn-info" onClick={this.edit} >Yes</button>
            &nbsp;
            <button type="button" className="btn btn-default" onClick={this.step} >No</button>
            <br /><br />
            </div> }
            
            { this.state.step == 'two' &&
            <div>
            Warning: are you sure you want to delete user {this.state.user.email} ?
            <br />
            Please, type your email address to confirm
            <br />
            <input onChange={this.email} className="form-control" placeholder="Enter your email" type="email" />
            <br /><br />
            <button type="button" className="btn btn-danger" onClick={this.click} >Yes</button>
            &nbsp;
            <button type="button" className="btn btn-default" onClick={this.step} >No</button>
            </div> }

          </li>
        </ul>
      </div>
      
      {/* <a href="#" onClick={this.click} className="btn btn-warning"> */}

      {/* <span className="translate">Delete User</span> */}
      {/* <span className="translate">Off</span> */}
      {/*}
      <i className="fa fa-trash"></i>
      &nbsp;
      <span className="translate">Remove</span>
      </a>
      */}
      <div className="text-success">{this.state.text}</div>
      </div>
    )
    
  }
  
  step = e => {
    if (this.state.step == 'one'){
      this.setState({ step: 'two' })
      this.button.click()
    } else {
      this.setState({ step: 'one' })
    }
  }
  
  email = e => {
    this.setState({ email: e.target.value })
  }
  
  edit = e => {
    $.ajax({
      url: '/account/find',
      data: {
        email: this.state.user.email,
      }
    }).then(r => {
      if (r.length){
        location.href = '/account/edit/' + r[0].account_id
      }
      if (!r.length){
        this.setState({ text: 'No accounts with that user' })
        setTimeout(() => this.setState({ text: '' }), 1000)
      }
    })
  }
  
  click = e => {
   // alert(this.state.value)
    if (this.state.email != this.state.user.email){
      this.setState({ text: 'Email mismatches' })
      setTimeout(() => this.setState({ text: '' }), 1000)
      return
    }
    app.log({
      value: 'user deleted'
    }).then( r => 
      $.ajax({
        url: '/user/' + this.state.value,
        type: 'DELETE',
      })
    ).then( r => 
      location.href = "/"
    )
    
  }
  
}

$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': window.token
  }
})


let deletes =  [...document.getElementsByClassName('delete')].map( e => {
  ReactDOM.render( <Delete value={ e.getAttribute('data-value') }  />, e) 
})