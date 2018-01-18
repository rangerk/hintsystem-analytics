import React from 'react'
import ReactDOM from 'react-dom'
import $ from 'jquery'


class Icons extends React.Component {
  
  constructor(props) {
    super(props)
    
    this.state = {
     // icons: ['icon1.png', 'icon2.png', 'icon3.png']
      icons: props.icons.split(','),
     // icon: null
      restrictions: null,
    }
    
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': window.token
      }
    })
        
  }
  
  render() {
   // const icons = this.state.icons
    return (
      <div>
        <div className="btn-group">
          {this.state.icons.map((e, i) => 
          <a className="btn btn-default" key={i} 
            onClick={event => this.click(event, i)} >
            <span className="translate">Upload Icon</span> {i + 1}
            &nbsp;
            <img src={ e } />
          
          
          </a>
            )}
          
        </div>
        <input multiple={true} type="file" id="f" name="f" 
          ref={r => this.file = r} 
          style={{ display: 'none' }} 
          onChange={this.change} 
        />
        &nbsp;
        { 
            this.state.restrictions &&
            <span className="label label-warning" >
              <i className="fa fa-close"></i>
              &nbsp;
              {this.state.restrictions}
            </span>
          }

      </div>
    )
  }
  
  click = (e, i) => {
    
    this.icon = i
   // this.setState({ icon: i })
    this.file.click()
    //this.upload()
  }
  
  upload = e => {
    if (this.validate(this.file.files[0])){
    let d = this.file.files[0]
    let fd = new FormData()
    fd.append('f', d)
    //fd.append('icons', this.state.icons.join(','))
    fd.append('icon', this.icon)

    fetch('/account/icon', {
      method: 'POST',
      headers: { 'X-CSRF-TOKEN': window.token },
    //  credentials: 'same-origin',
      body: fd,
      //body: ''
    }).then( r => r.text(), r => alert(JSON.stringify(r)) ).then( r => {
        //document.body.innerHTML=r
        const all = this.state.icons
        const icons = all.map((v, k) => k == this.icon ? r : v)
        this.setState({ icons: icons })
        fetch('/account/icons', {
          method: 'POST',
          headers: { 
            'X-CSRF-TOKEN': window.token,
            'Content-Type': 'application/json'
          },
       //   credentials: 'same-origin',
         // body: icons,
          
          body: JSON.stringify({ icons: icons.join(',') })
          
          /*
          body: { icons: icons }
          */
        })
          //.then(r => r.text()).then(r => alert(r))
    }).catch(r => alert('Try again'))
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
    
    if (f.size > 1024 * 50){
      items = [...items, '> 50kb']
    } else {
      let file = new FileReader()
      file.onload = e => {
        let img = new Image()
        img.onload = e => {
          // alert(JSON.stringify(img.width))
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
  
  change = e => {
    
    if (this.file.files.length < 1){
      alert('Please select file')
    } else {
      if(this.validate(this.file.files[0])){
        let data = new FormData()
        data.append('f', this.file.files[0])
        $.ajax({
          url: '/account/icon',
          type: 'POST',

          data: data,

          cache: false,
          contentType: false,
          processData: false,

        }).then(r => {

          const all = this.state.icons
          const icons = all.map((v, k) => k == this.icon ? r : v)
          this.setState({ icons: icons })
          $.ajax({
            url: '/account/icons', 
            type: 'POST',
            data: { icons: icons.join(',') }
          }).then(r => r, r => alert(JSON.stringify(r)) )
          .catch(r => alert(JSON.stringify(r)) )

        }, r => alert(JSON.stringify(r)) )
        .catch(r => alert(JSON.stringify(r)) )

      }
    }
  }
    
}

let icons = [...document.getElementsByClassName('icons')].map( e =>
ReactDOM.render(
  <Icons
  icons={e.getAttribute('data-icons')}
/>, e)
)