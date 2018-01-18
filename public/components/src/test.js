import React from 'react'
import ReactDOM from 'react-dom'
import $ from 'jquery'

import 'whatwg-fetch'

class Test extends React.Component {
  
  constructor(props) {
    super(props)
    this.state = {
      text: ''
    }
  }

  render(){
    return (
      <div>
        <a className="btn btn-default" onClick={this.click} >test</a>
        &nbsp;
        <a className="btn btn-default" onClick={this.test2} >test2</a>
        &nbsp;
        <a className="btn btn-default" onClick={this.test3} >test3</a>
        &nbsp;
        <a className="btn btn-default" onClick={this.test4} >test4</a>
        <div className="row"></div>
        <br />
        <a className="btn btn-default" onClick={this.test5} >test5</a>
        <div className="row"></div>
        <br />
        <div className="well">{this.state.text}</div>
      </div>
    )
  }
  
  test5 = e => {
    this.setState({ text: '...' })
    fetch(
    //  'http://api.hintsystem.com/headers', {
      'http://api.hintsystem.com/snippets', {
      headers: {
        'X-CSRF-TOKEN': window.token
      },
    }).then(
      r => r.json(),
      r => this.setState({ text: JSON.stringify(r) })
    ).then(
      r => this.setState({ text: JSON.stringify(r) }),
      r => this.setState({ text: JSON.stringify(r) })
    ).catch(
      r => this.setState({ text: JSON.stringify(r) })
    )
  }
  
  test4 = e => {
    this.setState({ text: '...' })
    $.ajax({
      url: 'http://api.hintsystem.com/positions',
      headers: { 'X-CSRF-TOKEN': window.token },
      type: 'POST',
      data: { snippet_id: 0 }
    }).then(
      r => this.setState({ text: JSON.stringify(r) }),
      r => this.setState({ text: JSON.stringify(r) })
    )
  }
  
  test3 = e => {
    this.setState({ text: '...' })
    $.ajax({
      url: 'http://api.hintsystem.com/snippets',
      headers: {
        'X-CSRF-TOKEN': window.token
      }
    }).then(
      r => $.ajax({
          url: 'http://api.hintsystem.com/positions',
          headers: { 'X-CSRF-TOKEN': window.token },
          type: 'POST',
          data: { snippet_id: r[0].id },
        })
     ).then(
         r => this.setState({ text: JSON.stringify(r) }),
         r => this.setState({ text: JSON.stringify(r) })
     )
  }
  
  test2 = e => {
    this.setState({ text: '...' })
    $.ajax({
      url: 'http://api.hintsystem.com/positions',
      headers: {
        'X-CSRF-TOKEN': window.token
      }
    }).then(
      r => this.setState({ text: JSON.stringify(r) }),
      r => this.setState({ text: JSON.stringify(r) })
    ).catch(
      r => this.setState({ text: JSON.stringify(r) })
    )
  }
  
  click = e => {
    this.setState({ text: '...' })
    $.ajax({
     // url: 'http://api.hintsystem.com/headers',
      url: 'http://api.hintsystem.com/snippets',
      headers: {
        'X-CSRF-TOKEN': window.token
      }
    }).then(
      r => this.setState({ text: JSON.stringify(r) }),
      r => this.setState({ text: JSON.stringify(r) })
    ).catch(
      r => this.setState({ text: JSON.stringify(r) })
    )
  }
}

let tests = [...document.getElementsByClassName('test')].map(
  e => ReactDOM.render(<Test />, e)
)