//import 'whatwg-fetch'
import React from 'react'
import ReactDOM from 'react-dom'
import $ from 'jquery'


class Icon extends React.Component {
  
  constructor(props) {
    super(props)
    
    this.state = {
      //icons: props.icons.split(',') || props.all.split(','),
      icons: props.icons !== '' ? props.icons.split(',') : props.all.split(','),
      icon: props.value,
      restrictions: null,
    }
    
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': window.token
      }
    })
    
  }
  
  render() {
    return (
      <div>
        <div className="btn-group">
          {this.state.icons.map( e =>
            <a
              onClick={ event => this.radio(event, e) }
              className={e == this.state.icon ? 'btn btn-info' : 'btn btn-default'} >
              <input type="radio" name="icon" 
                     value={ e } 
                     checked={ e == this.state.icon ? true : false } />
              &nbsp;
              <img src={ e } />
 
            </a>
          )}
        </div>
      
        <input multiple="true" onChange={this.change} ref={r => this.file = r} type="file" name="f" id="f" style={{display: 'none'}} />
        &nbsp; 
        <a onClick={this.click} className="btn btn-default translate">Upload</a>
        &nbsp;
        { 
          this.state.restrictions &&
          <span className="label label-warning" >
            <i className="fa fa-close"></i>
            &nbsp;
            {this.state.restrictions}
          </span>
        }

        <input type="hidden" value={this.state.icons.join(',')} name="icons" style={{ display: 'none' }} />

      </div>
    )
  }
  
  click = e => {
    this.file.click()
   
    //this.change(e)
    //this.upload(e)
  }
  
  change = e => {
    
  //  this.upload(e)
    
    //this.log('hello')
    if (this.file.files.length < 1){
      alert('Please select file')
    } else {
    if(this.validate(this.file.files[0])){
    let data = new FormData()
    data.append('f', this.file.files[0])
    $.ajax({
      url: '/icon',
      type: 'POST',
     // data: new FormData(this.file),
      //data: new FormData(this.file.files[0]),
      data: data,
      
      cache: false,
      contentType: false,
      processData: false,
      
    }).then(r => {
      //this.log(r)
      //this.log(this.state)
      //const all = this.state.icons
      const all = this.state.icons.slice(0, 3)
    //  if (!all.find(v => v == r)){
        this.setState({ 
          icons: [ ...all, r ],
          icon: r
        })
   //   }
    }, r => alert(JSON.stringify(r)) )
    .catch(r => alert(JSON.stringify(r)) )
    /*
    }, this.log)
    .catch(this.log)
    */
    }
    }
  }
/*
  log = r => {
    alert(JSON.stringify(r))
    console.log(r)
  }
  */
  radio = (e, v) => {
    // (e.target.value)

    //this.setState({ icon: e.target.value })
    this.setState({ icon: v })
  }
  
  upload = e => {
    /*
    fetch('/icon', {
      method: 'POST',
      body: ''
    })
      .then(r => r.text(), r => alert(JSON.stringify(r)) )
      .then(r => alert('Server answer is ' + JSON.stringify(r)) )
      .catch(r => alert(JSON.stringify(r)) )
      */
    //let d = e.target.files[0]

    if (this.file.files.length > 0){
      if(this.validate(this.file.files[0])){
        //alert('validated')
        let d = this.file.files[0]
        let fd = new FormData()
        fd.append('f', d)
        fetch('/icon', {
          method: 'POST',
          body: fd,
          headers: { 'X-CSRF-TOKEN': window.token }
        }).then( r => r.text(), r => alert(JSON.stringify(r)) ).then( r => {
            const all = this.state.icons
            this.setState({
              //icons: [...all, r],
              icons: [...all.slice(0, 3), r],
              icon: r
            })
        }).catch(r => alert('Try again'))
      }
    /*else {
      alert(' Select file please ')
    } */
    }
  }
  
  validate = f => {
    let items = []
    /*
    if (this.state.icons.find(e => [...e.split('/')].pop() == f.name)){
      items = [...items, 'Exists']
    }
    */
    if (!['png', 'jpg', 'gif', 'ico'].find(e => e == f.name.split('.')[1])){
      items = [...items, 'Not Pic']
    }
    //alert(f.size)
    if (f.size > 1024 * 50){
      items = [...items, '> 50kb']
    } else {
      let file = new FileReader()
      file.onload = e => {
        let img = new Image()
        img.onload = e => {
          if (img.width > 48 || img.height > 48){
            items = [...items, '> 48x48']
          }
        }
        //alert(window.URL.createObjectURL)
        img.src = e.target.result
      }
      file.readAsDataURL(f)
    }
    
    this.setState({
      restrictions: items.join(', ')
    })
    
    return items.length == 0
  }
  
}

let icon = [...document.getElementsByClassName('icon')].map( e =>
ReactDOM.render(
  <Icon 
  value={e.getAttribute('data-value')}
  icons={e.getAttribute('data-icons')}
  all={e.getAttribute('data-all')}
/>, e)
)