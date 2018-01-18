import React from 'react'
import ReactDOM from 'react-dom'
import $ from 'jquery'


class Clipboard extends React.Component {

  constructor(props){
    super(props)
    this.click = this.click.bind(this)
    this.copy = this.copy.bind(this)
    this.select = this.select.bind(this)
    this.state = { opacity: '0', transition: 'opacity 0.2s' }
  }
  
  render() {
    return (
      <div>
      <button type="button" className="btn btn-success" onClick={this.click} >
        <span className="translate">Copy to clipboard</span>
      </button>
      <div className="alert alert-success" 
        style={{
          backgroundColor: 'white',
          border: 'none',
         // transition: 'opacity 1s',
          transition: this.state.transition,
          opacity: this.state.opacity,
          position: 'absolute'
        }} >
        {/*Copied!*/}
        <span className="translate">copied</span>
      </div>
      </div>
    )
  }

  click(e){
    //alert(this.state.opacity)
    this.copy(this.props.target)
    //this.setState({ opacity: '1' });
    this.setState({ opacity: '1', transition: 'opacity 0.1s' });
    //setTimeout(() => this.setState({ opacity: '0' }), 2000)
    setTimeout(() => this.setState({ opacity: '0', transition: 'opacity 1s' }), 500)
  }
  
  copy(id) {
    let e = document.getElementById(id);
    e.contentEditable = true;
    e.focus();
    let r = this.select(e);
    document.execCommand('copy');
    if (r.execCommand){
      r.execCommand('copy');
    }
    // e.blur();
  }

  select(e){
    // alert(window.getSelection());
    if (window.getSelection()){
      var r = document.createRange();
      r.selectNodeContents(e);
      window.getSelection().removeAllRanges();
      window.getSelection().addRange(r);
      return r;
    }
  
    // alert(document.selection);
    if (document.selection){
      var r = document.body.createTextRange();
      r.moveToElementText(e);
      r.select();
      return r;
    }
  }
    
}

[...document.getElementsByClassName('clipboard')].map(e => 
ReactDOM.render(<Clipboard target={e.getAttribute('data-target')} />, e))