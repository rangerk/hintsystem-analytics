import React from 'react'
import ReactDOM from 'react-dom'
import $ from 'jquery'

class Details extends React.Component {

  constructor(props){
    super(props)
        
    this.state = { value: props.value }
    
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': window.token
      }
    })
  }
  
  render() {
    
    return (
      <div>
        Hello
      </div>
    )
  }

  click = e => {
    alert(this.state.value)
    
  }
  
  save = (event, e, t) => {
    if (String.fromCharCode( event.keyCode || event.charCode ) == '\r'){
      event.target.blur()
    }
    
    if (this.request) {
      this.request.abort()
    }

    if (t == 1) {
      e.nickname = event.target.textContent
    }
    if (t == 2) {
      e.content = event.target.textContent
    }
    
    this.request = $.ajax({
      url: '/snippet',
      type: 'PUT',
      data: { id: e.id, content: e.content, nickname: e.nickname }
    }).then(
      r => r //this.setState(v => { value: v.map(elem => elem.id == r.id ? r : elem)})
      //, err => alert(JSON.stringify(err))
    ).catch(err => alert(JSON.stringify(err)))
  }
  
}

[...document.getElementsByClassName('details')].map(e => 
  ReactDOM.render(<Details value={JSON.parse(e.getAttribute('data-value'))} />, e)
)