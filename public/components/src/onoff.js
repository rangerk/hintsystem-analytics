import React from 'react'
import ReactDOM from 'react-dom'
import $ from 'jquery'


class OnOff extends React.Component {
    constructor(props) {
        super(props)
        this.toOn = this.toOn.bind(this);
        this.toOff = this.toOff.bind(this);
        this.toggle = this.toggle.bind(this);

        
        if (props.value == 'on') {
                    this.state = {value: 'on', left: 70, input: props.name}
        } else {
                    this.state = {value: 'off', left: 20, input: props.name}
        }
    }
  
    render() {
        return  (
                <div className="btn-group col-sm-10" data-toggle="buttons">
          <label type="button" 
          className={this.state.value == 'on' ? "btn btn-info" : "btn btn-default active"} onClick={this.toggle}
          style={{ 
            borderRadius: '50px 0px 0px 50px',
            border: 'none' }} >
                 <input type="radio" name="" value="on" checked />
                 <span className="translate">On</span>
          </label>
          
          <label type="button" 
          className={this.state.value == 'on' ? "btn btn-info" : "btn btn-default active"} onClick={this.toggle}
          style={{
            borderRadius: '0px 50px 50px 0px', 
            border: 'none' }} >
                 <input type="radio" name="" value="off" checked />
                 <span className="translate">Off</span>
           </label>
          
          <label type="button" className="btn btn-default" onClick={this.toggle}
          style={{ position: 'absolute', 
            left: this.state.left + 'px',
            transition: 'left 0.5s',
            zIndex: '10',
            width: '30px',
            height: '30px',
            top: '1px',
            borderRadius: '50px'
            }} >
                 <input type="hidden" name={this.state.input} value={this.state.value} />&nbsp;
          </label>
          </div>
        )
    }
  
    toOn(event) {
        this.setState({value: 'on', left: 70})
        //alert(this.state.value)
    }
  
    toOff(event) {
        this.setState({value: 'off', left: 20})
       // alert(this.state.value)
    }
 
    toggle(event) {
        //event.preventDefault()
       // event.stopPropagation()
        if (this.state.value == 'on') {
            this.toOff(event)
        } else {
            this.toOn(event)
        }
    }
}

let onoff = [...document.getElementsByClassName('on-off')].map( e => {
let value = e.querySelector('input').value
let name = e.querySelector('input').name
ReactDOM.render(
  <OnOff name={name} value={value} />, e
)
})