import React from 'react'
import ReactDOM from 'react-dom'
import $ from 'jquery'

import app from './log.js'

class Submit extends React.Component {
  
  constructor(props) {
    super(props)
    this.submitClick = this.submitClick.bind(this)
    this.state = {
      opacity: 0, 
      //text: 'Saved!', 
      text: 'saved',
      transition: 'opacity 0.1s',
      disabled: 'disabled'
    }
  }
  
  render() {
    return (
        <div>
        <button ref={r => this.button = r} type="button" 
          className={'btn btn-success disabling ' + this.state.disabled}
          onClick={this.submitClick}
        >
          <i className="fa fa-btn fa-save"></i>
          <span className="translate">Save</span>
        </button>
        <div className="alert alert-success" 
          style={{
            backgroundColor: 'white', 
            //backgroundColor: '',
            border: 'none', 
            //transition: 'opacity 1s',
            transition: this.state.transition,
            opacity: this.state.opacity,
            position: 'absolute'
          }}>
          <span className="translate">{this.state.text}</span>
        </div>
        </div>
    )
  }
  
  submitClick(e) {
    //app.log({value: 'save'})
    if ($(this.button).hasClass('disabled')){
    //if (this.state.disabled != ''){
      return
    } else {
      //$('.disabling').addClass('disabled')
    }
    //this.setState({opacity: 1, text: 'Saving...'})
    //this.setState({opacity: 1, text: 'Saved!'})
    //this.setState({opacity: 1, text: 'saved', transition: 'opacity 0.2s', disabled: ''})
    this.setState({opacity: 1, transition: 'opacity 0.2s', disabled: ''})
    // alert(this.button.form.action)
  //  alert( $(this.button.form).serialize() )
    $.ajax({
      url: this.button.form.action,
      //type: 'POST',
      type: this.button.form.method,
      data: $(this.button.form).serialize(),
     // timeout: 1000
    }).then(res => {
      //alert(res)
     // setTimeout(() => this.setState({opacity: 0, text: 'Saved!'}), 1000)
      //this.setState({opacity: 0, text: 'Saved!'})
      //setTimeout(() => this.setState({opacity: 0, text: 'Saved!'}), 100)
      //this.props.cb()
      $('.disabling').addClass('disabled')
      //setTimeout(() => this.setState({opacity: 0, text: 'saved', transition: 'opacity 1s', disabled: 'disabled'}), 100)
      setTimeout(() => this.setState({opacity: 0, transition: 'opacity 1s', disabled: 'disabled'}), 100)
      //alert(this.button.form.action)
      if (this.button.form.action.split('/').find(e => e == 'snippet')){
        //alert(this.button.form.id.value)
        app.log({
          value: 'hint changed',
          snippet_id: this.button.form.id.value
        })
      }
      if (this.button.form.action.split('/').find(e => e == 'account')){
        app.log({
          value: 'account changed'
        })
      }
    })//, e => {
      //setTimeout(() => this.setState({opacity: 0, text: "Try again!"}), 1000)
      //document.body.innerHTML = e.responseText
  //  }).catch(e => {
     // setTimeout(() => this.setState({opacity: 0, text: "Not saved!"}), 1000)
   // })
   // alert('hello')
    //this.file.click()
   // alert(this.button.form)
  }
  
}

let f = () => {
  let submit = [...document.getElementsByClassName('submit')].map(e => 
    ReactDOM.render(<Submit name={e.id} value={e.innerHTML} cb={f} log={ e.getAttribute('data-log') } />, e))
}
f()