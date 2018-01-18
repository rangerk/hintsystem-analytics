import React from 'react'
import ReactDOM from 'react-dom'
import $ from 'jquery'

class Reset extends React.Component {
  
  constructor(props) {
    super(props)
    
    this.state = {
      value: props.value,
      reset: false,
    }
    
    //alert(JSON.stringify(props.value))
  }
  
  render() {
    
    return (
      <div>
      
      <div style={{ 
        display: this.state.reset ? '' : 'none',
        opacity: this.state.reset ? '1' : '0',
        transition: 'opacity 1s'
      }}>
        <a href={ '/votes/reset/' + this.state.value } className="btn btn-success translate">Reset</a>
        
        <a onClick={e => this.click(e, 2)} className="btn btn-default translate">Don't</a>
      </div>
      <a
        className="btn btn-info translate"
        onClick={e => this.click(e, 0)}
        style={{ display: this.state.reset ? 'none' : '' }}
      >Reset to 0/0</a>
      
      </div>
    )
    
  }
  
  click = (e, v) => {
    const  url = '/votes/reset/' + this.state.value 
    //alert(e)
    if (v == 1){
      $.ajax({
        url: url,
        // data: { value: v }
      }).then(r => {
        //alert(r)
        this.setState({ reset: false })
        
      })
    }
    if (v == 2){
      this.setState({ reset: false })
    }
    if (v == 0){
      this.setState({ reset: true })
    }
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
let resets =  [...document.getElementsByClassName('reset')].map( e => {
  ReactDOM.render( <Reset value={ e.innerHTML } />, e) 
})