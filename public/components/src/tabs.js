import React from 'react'
import ReactDOM from 'react-dom'
import $ from 'jquery'


class Tabs extends React.Component {
  
  constructor(props) {
    super(props)
    
    this.state = {
      value: props.value,
      
    }
    
    //alert(JSON.stringify(props.value))
  }
  
  render() {
    
    return (
      <ul className="nav nav-tabs">
        <li className={this.state.value == 'settings' ? 'active' : ''}><a className="translate" onClick={e => this.click(e, 'settings')} href="#settings" data-toggle="tab">Settings</a></li>
        <li className={this.state.value == 'feedback' ? 'active' : ''}><a className="translate" onClick={e => this.click(e, 'feedback')} href="#feedback" data-toggle="tab">Feedback</a></li>
      </ul>
    )
    
  }
  
  click = (e, v) => {
  //  alert(v)
    $.ajax({
      url: '/tab',
      data: { value: v }
    })
  }
  
}
/*
$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': window.token
  }
})
*/
/*
$.ajax({
  url: '/translate'
}).then(r => 
  [...document.getElementsByClassName('translate')].map( e => {
    ReactDOM.render( <Translate value={ e.innerHTML } all={r} />, e) 
  })
)
*/
let tabs =  [...document.getElementsByClassName('snippet-tabs')].map( e => {
  ReactDOM.render( <Tabs value={ e.innerHTML } />, e) 
})