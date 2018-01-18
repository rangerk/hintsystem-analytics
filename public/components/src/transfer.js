import React from 'react'
import ReactDOM from 'react-dom'
import $ from 'jquery'


class Transfer extends React.Component {
  
  constructor(props) {
    super(props)
    
    this.state = {
      text: '',
      classes: 'text-success pull-right',
      users: [],
      account: { nickname: 'UNKNOWN' },
      email: '',
    }

  }
  
  render() {
    
    return (
      <div className="row">
          <div className="col-sm-3 text-muted">Transfer Ownership:</div>
          <div className="col-sm-6">
            <div className={'form-group' + (this.state.text && ' has-success')} >
              <input onChange={this.email} className="form-control" placeholder="Enter email of new owner" />
              <span className="help-block">{this.state.text}</span>
            </div>
          </div>
          <div className="col-sm-3">
            
            <div className="dropdown">
            <button className="btn btn-default dropdown-toggle" 
                    data-toggle="dropdown" type="button">Transfer</button>
            <ul className="dropdown-menu">
              <li className="dropdown-header">
                Transfer Ownership ?
                <br />
                Recipient must be user of this account 
                <br />
                before you can transfer to them.
                <br />
                Warning: do you want to transfer 
                <br />
                account { this.state.account.nickname }
                <br />
                to { this.state.email } ?
                <br /><br />
                <button type="button" className="btn btn-info" onClick={this.click} >Yes</button>
                &nbsp;
                <button type="button" className="btn btn-default">No</button>
              </li>
            </ul>
          </div>
            
          </div>
          
        </div>
    )
    
  }
  
  email = e => {
    this.setState({
      email: e.target.value
    })
  }
  
  componentDidMount(){
    $.ajax({
      url: '/invites'
    }).then(r => {
      this.setState({ users: r })
      return $.ajax({
        url: '/account/current'
      })
    }).then(r => {
      this.setState({ account: r })
    })
  }
  
  click = e => {
    if (!this.state.users.find(v => v.email == this.state.email)){
      this.setState({ text: 'Email not found' })
      setTimeout(() => this.setState({ text: '' }), 1000)
      return
    }
    $.ajax({
      url: '/account/transfer/' + this.state.account.id,
      data: {
        email: this.state.email
      }
    }).then(r => {
      location.href = '/accounts'
    })
  }
  
}

$.ajaxSetup({
  headers: {
    //'X-CSRF-TOKEN': window.token
    'X-CSRF-TOKEN': sessionStorage.token
  }
})


let transfers = [...document.getElementsByClassName('transfer')].map(e => {
  return ReactDOM.render( <Transfer />, e )
})
