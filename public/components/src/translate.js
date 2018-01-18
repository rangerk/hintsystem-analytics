import React from 'react'
import ReactDOM from 'react-dom'
import $ from 'jquery'


class Translate extends React.Component {
  
  constructor(props) {
    super(props)
    
    this.state = {
      value: props.value,
      all: props.all.values,
      translated: null,
      selected: props.all.selected || 'en'
    }
    
    //alert(JSON.stringify(props.all))
  }
  
  render() {
    
    return (
      <span
        onClick={this.click}
      >
        { this.state.translated ||
          this.state.all.find(e => e.key == this.state.value) ?
          this.state.all.filter(e => e.key == this.state.value)[0][this.state.selected]
          :
          (this.state.value + ' translating...')
        }
      </span>
    )
    
  }
  
  click = e => {
    /*e.preventDefault()
    e.stopPropagation()*/
    //alert(this.state.value)
    if(!this.state.all.find(e => e.key == this.state.value)){
      e.preventDefault()
      e.stopPropagation()
      $.ajax({
        url: '/translate/add',
        data: { value: this.state.value }
      }).then(r => alert(JSON.stringify(r)), r => alert(r))
      .catch(r => alert(r))
    }
  }
  /*
  change = (e, v) => {
    this.setState({ value: v })
  }
  
  log = r => {
    //alert(JSON.stringify(r))
    //console.log(r)
  }
  */
  
}
/*
$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': window.token
  }
})
*/
$.ajax({
  url: '/translate'
}).then(r => 
  [...document.getElementsByClassName('translate')].map( e => {
    if (e.title) {
      //alert(e.title + JSON.stringify(r))
      //alert(e.title)
      e.title = r.values.find(v => v.key == e.title) ? 
        r.values.filter(v => v.key == e.title)[0][r.selected || 'en'] 
        : (e.title + ' translating...')
      //e.title = r.values.filter(v => v.key == e.title)[0][r.selected || 'en']
    //  alert(e.title)
    } else {
      ReactDOM.render( <Translate value={ e.innerHTML } all={r} />, e) 
    }
  })
  
)

