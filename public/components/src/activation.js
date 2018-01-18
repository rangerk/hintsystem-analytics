import React from 'react'
import ReactDOM from 'react-dom'
import $ from 'jquery'


class Activation extends React.Component {
  
  constructor(props) {
    super(props)
    
   // alert('hello')
    
    this.state = {
      value: props.value,
      all: [
        { value: 'persistent', name: 'Persistent (always showing)' },
        { value: 'click', name: 'Click' },
        { value: 'mouse', name: 'Mouse over' }
      ]
    }
    
    /*
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': window.token
      }
    })
    */
   // alert('hello')
  }
  
  render() {
    //return <h1>hello</h1>
    
    return (
      
        <div className="btn-group">
          {this.state.all.map( e =>
            <a
              onClick={ event => this.change(event, e.value) }
              className={ e.value == this.state.value ? 'btn btn-info' : 'btn btn-default' } >
              <input type="radio" name="activation"
                     value={ e.value } 
                     checked={ e.value == this.state.value ? true : false } 
                     /> 
              <span className="translate">{ e.name }</span>
            </a>
          )}
      </div>
    )
    
  }
  
  change = (e, v) => {
    this.setState({ value: v })
  }
  /*
  log = r => {
    //alert(JSON.stringify(r))
    //console.log(r)
  }
  */
}

let activation = [...document.getElementsByClassName('activation')].map( e => 
ReactDOM.render( <Activation value={ e.getAttribute('data-value') } />, e))
