import React from 'react'
import ReactDOM from 'react-dom'
import $ from 'jquery'


class Invite extends React.Component {
  
  constructor(props) {
    super(props)
    
    this.state = {
      text: '',
      classes: 'text-success pull-right',
      users: [],
      account: { nickname: 'UNKNOWN' },
    }
    
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': sessionStorage.token
      }
    })

  }
  
  render() {
    
    return (
      <div>
      <div className="row">
        <div className="col-sm-3 text-muted">Owner {/* name email */} </div>
      </div>
      {this.state.users.map(e =>
      /* e.status == 'ok' && */
      /* e.status == 'ok' && e.role == 'owner' && */
      e.role == 'owner' &&
      <div className="row">
        <div className="col-sm-3"></div>
        <div className="col-sm-1">
          
       {/* <span onClick={event => this.remove(event, e)} className="label label-info">x</span> */}
          
        <div className="dropdown">
          <button className="btn btn-default dropdown-toggle" data-toggle="dropdown" type="button">x</button>
          <ul className="dropdown-menu">
          <li className="dropdown-header">
            Are you sure you want to remove 
            <br />
            user {e.email} 
            <br />
            from account {this.state.account.nickname} ?
            <br /><br />
            <span onClick={event => this.remove(event, e)} 
              className="btn btn-info">Yes, remove
            </span>
            &nbsp;
            <span className="btn btn-default">No, don't remove</span>
          </li>
          </ul>
          </div>
      
        </div>
        <div className="col-sm-4">{e.email}</div>
{/* <div className="col-sm-2">{e.nickname}</div> 
        <div className="col-sm-2">{e.role}</div> */}
      </div>
      )}
      <br /><br />
      
      <div className="row">
        <div className="col-sm-3 text-muted">Users {/* name email */} </div>
      </div>

      {this.state.users.map(e =>
      e.status == 'ok' && e.role == 'regular' &&
      <div className="row">
        <div className="col-sm-3"></div>
        <div className="col-sm-1">
          
       {/* <span onClick={event => this.remove(event, e)} className="label label-info">x</span> */}
          
        <div className="dropdown">
          <button className="btn btn-default dropdown-toggle" data-toggle="dropdown" type="button">x</button>
          <ul className="dropdown-menu">
          <li className="dropdown-header">
            Are you sure you want to remove 
            <br />
            user {e.email} 
            <br />
            from account {this.state.account.nickname} ?
            <br /><br />
            <span onClick={event => this.remove(event, e)} 
              className="btn btn-info">Yes, remove
            </span>
            &nbsp;
            <span className="btn btn-default">No, don't remove</span>
          </li>
          </ul>
          </div>
      
        </div>
        <div className="col-sm-4">{e.email}</div>
{/* <div className="col-sm-2">{e.nickname}</div>
        <div className="col-sm-2">{e.role}</div> */}
      </div>
      )}
      <br /><br />
        
      <div className="row">
        <div className="col-sm-3 text-muted">Pending Invitations {/* email */} </div>
      </div>
<br /><br />    
      {this.state.users.map(e =>
      /*"e.status != 'ok' && */
      e.status != 'ok' && e.role == 'regular' &&
      <div>
      <div className="row">
        <div className="col-sm-3"><a onClick={event => this.update(event, e)} className="btn btn-default">Re-send invitation</a></div>
        <div className="col-sm-1">
          <div className="dropdown">
          <button className="btn btn-default dropdown-toggle" data-toggle="dropdown" type="button">x</button>
          <ul className="dropdown-menu">
          <li className="dropdown-header">
            Are you sure you want to remove 
            <br />
            user {e.email} 
            <br />
            from account {this.state.account.nickname} ?
            <br /><br />
            <span onClick={event => this.remove(event, e)} 
              className="btn btn-info">Yes, remove
            </span>
            &nbsp;
            <span className="btn btn-default">No, don't remove</span>
          </li>
          </ul>
          </div>
        </div>
        <div className="col-sm-4">{e.email}</div>
{/* <div className="col-sm-2">{e.nickname}</div>
        <div className="col-sm-2">{e.status}</div> */}
      </div>
      <br />
      </div>
      )}
      <br /><br />
      
      <div className="row">
        <div className="col-sm-3 text-muted">Invite new user:</div>
        <div className="col-sm-6">
          <div className={ 'form-group' + (this.state.text && ' has-success')} >
            <input className="form-control" placeholder="Enter email of new user"
              ref={r => this.email = r} />
          </div>
        </div>
        <div className="col-sm-3">
          <a onClick={this.send} className="btn btn-default">Send</a>
          <div className="text-success"
            style={{ 
                   transition: 'opacity 1s',
                   opacity: this.state.text ? '1' : '0',
                   position: 'absolute'
                  }}
          >{this.state.text}</div>
      </div>
      </div>
      <br />
      
      </div>
    )
    
  }
  
  componentDidMount(){
    $.ajax({
      url: '/invites'
    }).then(r => {
      this.setState({
        users: r
      })
      $.ajax({
        url: '/account/current'
      }).then(r => {
        this.setState({
          account: r
        })
      })
    })
  }
  
  send = e => {
    if (!this.email.value){
      this.setState({ text: 'Enter email' })
      this.email.style.backgroundColor = '#ffeeee'
      setTimeout(() => {
        this.email.style.backgroundColor = ''
        this.setState({ text: '' })
      }, 1000)
      return
    }
    if (this.state.users.find(v => v.email == this.email.value)){
      this.setState({ text: 'User exists' })
      this.email.value = ''
      this.email.style.backgroundColor = '#ffffee'
      setTimeout(() => {
        this.email.style.backgroundColor = ''
        this.setState({ text: '' })
      }, 1000)
      return
    }
    $.ajax({
      url: '/invite',
      type: 'POST',
      data: { 
        email: this.email.value || '???',
        nickname: 'nickname' + this.state.users.length,
        //status: 'pending',
        //token: '',
      },
    }).then(r => {
      const all = this.state.users
      this.setState({
        users: [ ...all, r ], 
      })
      if (this.email.value){
        $.ajax({
          url: '/email/invite',
          data: r,
          // type: 'POST',
        })
      }
    })
  }
  
  remove = (event, e) => {
    $.ajax({
      url: '/invite/delete/' + e.id
    }).then(r => {
      const all = this.state.users
      this.setState({
        users: all.filter(v => v.id !== e.id)
      })
    })
  }
  
  update = (event, e) => {
    $.ajax({
      url: '/invite/update/' + e.id,
      data: {
        //token: 'new token'
      }
    }).then(r => {
      const all = this.state.users
      this.setState({
        users: all.map(v => v.id == e.id ? r : v)
      })
      if (r.email != '???'){
        $.ajax({
          url: '/email/invite',
          data: r,
          // type: 'POST',
        })
      }
    })
  }
  
}

$.ajaxSetup({
  headers: {
    //'X-CSRF-TOKEN': window.token
    'X-CSRF-TOKEN': sessionStorage.token
  }
})


let invites = [...document.getElementsByClassName('invite')].map(e => {
  return ReactDOM.render( <Invite />, e )
})
