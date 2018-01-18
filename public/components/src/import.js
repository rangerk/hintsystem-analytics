import React from 'react'
import ReactDOM from 'react-dom'
import $ from 'jquery'


class Import extends React.Component {
  
  constructor(props) {
    super(props)
    
    this.state = {opacity: 0, transform: 'scale(0, 1)', check: 'replace'}
  }
  
  render() {
    return (
      <div>
      
        <div>
          <input onChange={this.change} ref={r => this.file = r} type="file" name={this.props.name} id={this.props.name} style={{display: 'none'}} />
          <button type="button" onClick={this.click} className="btn btn-default translate">Import hints</button>
          <button ref={r => this.submit = r} type="submit" style={{display: 'none'}} />
        </div>
      
        <div style={{ 
          opacity: this.state.opacity,
          maxWidth: this.state.maxWidth,
          transition: 'opacity 1s, max-height 1s, transform 1s',
          transform: this.state.transform,
          position: 'absolute',
          
        }} >
          <div className="text-muted translate">Options</div>
          <div className="btn-group">
              <label type="button" className="btn btn-info" >
                  <input type="radio" name="options" 
                         value="replace" /><span className="translate">Replace</span>
              </label>
              <label type="button" className="btn btn-default" >
                  <input type="radio" name="options" 
                         value="merge" /><span className="translate">Merge</span>
              </label>
              <label type="button" className="btn btn-default" >
                  <input type="radio" name="options" 
                         value="append" /><span className="translate">Append</span>
              </label>
          </div>
          &nbsp;
          <a className="btn btn-default translate" onClick={this.send} >Submit</a>
      
        </div>
     
      </div>
    )
  }
  
  click = e => {
    //this.file.click()
    if (this.state.opacity == 0){
      this.setState({opacity: 1, transform: 'scale(1, 1)'})
    } else {
      this.setState({opacity: 0, transform: 'scale(0, 1)'})
    }
  }
  
  change = e => {
    // this.submit.click()
    
        let data = new FormData()
        data.append('f', this.file.files[0])
        $.ajax({
          url: '/account/import',
          type: 'POST',

          data: data,

          cache: false,
          contentType: false,
          processData: false,

        }).then(r => {
          location.href = '/'
        })
  }
  
  send = e => {
    this.file.click();
   // this.submit.click()
    //alert('hello')
   // this.change()
  }
  
  radio = e => {
    alert('hello')
  }
  
}

let imp = [...document.getElementsByClassName('import')].map( e => 
ReactDOM.render(<Import name={e.id} value={e.innerHTML} />, e))