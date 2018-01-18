import React from 'react'
import ReactDOM from 'react-dom'
import $ from 'jquery'


class Settings extends React.Component {
  
  constructor(props) {
    super(props)
    
    this.state = {
      text: 'Text',
      opacity: '0',
    }

  }
  
  render() {
    
    return (
      <div>
      
      <div className="row">
        <div className="col-sm-offset-8">
          <a href="#" onClick={this.click} 
            ref={r => this.save = r}
            className="btn btn-success disabled" 
            >
            <i className="fa fa-save"></i>
            &nbsp;
            Save
          </a>
          <div className="alert alert-success"
            style={{
              backgroundColor: 'transparent',
              opacity: this.state.opacity,
              position: 'absolute',
              transition: 'opacity 0.5s',
              border: 'none',
            }}
          >{this.state.text}</div>
          &nbsp;
          <a href="/" className="btn btn-default">Cancel</a>
          <input type="submit" className="hidden" ref={r => this.button = r} />
        </div>
      </div>
      <br />
      
      </div>
    )
    
  }
  
  click = e => {
    $.ajax({
      url: '/user/validate',
      data: $(this.button.form).serialize(),
    }).then(r => {
      if(!r.current){
        this.setState({ opacity: '1', text: 'Current password mismatch' })
        setTimeout(() => this.setState({ opacity: '0' }), 500)
      }
      if (r.current){
        $.ajax({
            url: '/user',
            type: 'POST',
            data: $(this.button.form).serialize(),
        }).then(r => {
          $(this.save).addClass('disabled')
          this.setState({ opacity: '1', text: 'Saved' })
          setTimeout(() => this.setState({ opacity: '0' }), 500)
        })
      }
    })
  }
  
}

let settings = [...document.getElementsByClassName('settings')].map(e => {
  return ReactDOM.render( <Settings />, e )
})