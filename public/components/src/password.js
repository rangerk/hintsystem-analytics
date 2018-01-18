import React from 'react'
import ReactDOM from 'react-dom'
import $ from 'jquery'


class Password extends React.Component {
  
  constructor(props) {
    super(props)
    
    this.state = { info: this.change(props.store.password) }
    
    /*
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': window.token
      }
    })
    */
    
  }
  
  render() {
    //this.log(this.state)
    return (
      <div>
        
      <div className="row">
        
        <div className={this.state.info ? 'col-sm-8' : 'col-sm-12'} >
          <input type="password" className="form-control" name="password" 
            onChange={this.update}
            value={this.props.store.password}
          />
        </div>
      
      {(this.props.store.password || this.props.store.confirm) &&
      <div className={this.state.info ? 'col-sm-4' : 'col-sm-0'} >
        <div style={{ position: 'absolute' , right: '10px', zIndex: '10' }} >
          { this.state.info && this.state.info.map( e => 
              <div>
                <span className={ !e.value ? 'label label-warning' : 'label label-info' } >
                  <i className={ !e.value ?  'fa fa-close' : 'fa fa-check' } 
                    style={{ minWidth: '15px' }}
                  ></i>
                  &nbsp;
                  { e.name }
                </span>
                <br />
              </div>
            )
          }
        </div>
      </div>
      }

      </div>
          
      </div>
    )
    
  }
  
  change = p => {
   // const v = event.target.value.split('')
  //  alert(p)
   // const v = this.props.store.password.split('')
    const v = p.split('')
    // let i = []
    let i = {
      uppercase: true,
      lowercase: true,
      number: true,
      length: true,
      
      match: true,
    }
    
    if (!v.find( c => c == c.toUpperCase() && c !== c.toLowerCase() )){
      // i = [ ...i, ' no uppercase ']
      i.uppercase = false
    }
    
    if (!v.find( c => c !== c.toUpperCase() && c == c.toLowerCase() )){
      //i = [ ...i, ' no lowercase ' ]
      i.lowercase = false
    }
    
    if (!v.find( c => $.isNumeric(c) )){
      // i = [ ...i, ' no numbers ' ]
      i.number = false
    }
    
    //if (v.length < 10){
    if (v.length < 9){
      // i = [ ...i, ' less than 10 characters ' ]
      i.length = false
    }
    //alert (this.props.store.password + ' ' + this.props.store.confirm)
    if (this.props.store.password != this.props.store.confirm){
      i.match = false
    }
    /*
    this.setState({
      info: Object.keys(i).map(e => { 
        const v = { name: e, value: i[e] } 
        return v
      } )
    })
    */
    return Object.keys(i).map(e => { 
        const v = { name: e, value: i[e] } 
        return v
      } )
  }
  /*
  log = r => {
    alert(JSON.stringify(r))
    //console.log(r)
  }
  */
  update = e => {
    this.props.store.password = e.target.value
    this.setState({
      info: this.change(this.props.store.password)
    })
  }
}

class Confirm extends React.Component {
  render(){
    return (
      <div className="row">
      <div className="col-sm-8" >
      <input id="match" onChange={ this.change }
        type="password" 
        className="form-control"
        name="password_confirmation" />
      </div>
      </div>
    )
  }
  
  change = e => {
    this.props.store.confirm = e.target.value
    this.props.cb()
  }
}

let s = {
  password: '',
  confirm: '',
}

let cb = () => {
  ReactDOM.render( 
    <Password store={s} key={Math.random()} />, 
    document.getElementsByClassName('password')[0]
  )
}

cb(null)

ReactDOM.render( 
  <Confirm cb={cb} store={s} />, 
  document.getElementsByClassName('confirm')[0]
)

