import React from 'react'
import ReactDOM from 'react-dom'
import $ from 'jquery'


class Type extends React.Component {
  
  constructor(props) {
    super(props)
    
    this.state = {
      value: props.value,
      all: [
        { value: 'inline', name: 'Inline' },
        { value: 'floating', name: 'Floating' },
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
    
    
    return (
      
        <div className="btn-group">
          {this.state.all.map( e =>
            <a
              onClick={ event => this.change(event, e.value) }
              className={ e.value == this.state.value ? 'btn btn-info' : 'btn btn-default' } >
              <input type="radio" name="type"
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
  
  log = r => {
    //alert(JSON.stringify(r))
    //console.log(r)
  }
  
}

let type = [...document.getElementsByClassName('type')].map( e => {
ReactDOM.render( <Type value={ e.getAttribute('data-value') } />, e)
                                                            })
