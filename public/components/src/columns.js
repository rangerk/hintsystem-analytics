import React from 'react'
import ReactDOM from 'react-dom'
import $ from 'jquery'


class Columns extends React.Component {
  
  constructor(props) {
    super(props)
    //alert(props.value)
    this.state = {
      value: props.value,
      all: [
        { name: 'Id', disabled: true, checked: true, },
        { name: 'Nickname', checked: true, },
        { name: 'Content', checked: true, },
        { name: 'On/Off', },
        { name: 'Author', },
        { name: 'Created', },
        { name: 'Modified', },
        { name: 'Template', },
        { name: 'Activation', },
        { name: 'Icon', },
        { name: 'Header', },
        { name: 'Footer', },
        { name: 'Voting', },
        { name: 'Votes', },
        { name: 'Comments', },
        { name: 'Tags', },
        { name: 'Analytics', },
        { name: 'Snippet', disabled: true, checked: true, },
      ].map(e => props.value.split(',').find(v => e.name == v) ? 
            { name: e.name, disabled: e.disabled, checked: true } : 
            { name: e.name, disabled: e.disabled, checked: false }),
    }
    
  }
  
  render() {

    return (
      <div className="row">
      <div className="form-inline" >
          { this.state.all.map( (e, i) => 
            <div className="checkbox col-sm-3">
              <label>
                <input type="checkbox" 
                  disabled={ e.disabled }
                  defaultChecked={ e.checked }
                  onClick={ event => this.click(event, e) }
                  name={ 'name' + i }
                  key={ 'key' + i }
                />
                &nbsp;
                <span className="translate">{ e.name }</span>
              </label>
            </div>
          )}
        
        <input type="hidden" name="columns" value={this.state.value} />
      </div>
      </div>
    )
    
  }
  
  click = (event, e) => {
   // event.stopPropagation();
    e.checked = e.disabled ? e.checked : !e.checked
    const all = this.state.all.map( v => v.name == e.name ? e : v )
    //alert( all.filter( v => v.checked ).map( v => v.name ).join(',') )
    this.setState({
      all: all,
      value: all.filter( v => v.checked ).map( v => v.name ).join(',')
    }) 

    //alert(JSON.stringify(this.state.all))
    /*app.log({
      value: 'logout'
    })*/
  }
  
}

/*
$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': window.token
  }
})
*/

let columns =  [...document.getElementsByClassName('columns')].map( e => {
  ReactDOM.render( <Columns value={ e.innerHTML } />, e) 
})