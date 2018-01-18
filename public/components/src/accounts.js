import React from 'react'
import ReactDOM from 'react-dom'
import $ from 'jquery'


class Accounts extends React.Component {
  
  constructor(props) {
    super(props)
    // alert(JSON.stringify(props))
    this.state = {
      all: props.all || [],
      one: props.one,
      invites: props.invites || [],
    }
    
  }
  
  render() {
    
    return (
      <div className="text-muted">
      
        <div className="row">
          <div className="col-sm-12 translate">My Accounts</div>
        </div>
        <br />
      
      <div className="row">
          <div className="col-sm-2">Id</div>
          <div className="col-sm-4">Nickname</div>
      </div>
      <br />
        {this.state.all.map( (e, i) => 
           <div>
           <div key={'k' + i} className="row">
             <div className="col-sm-2">{e.id}</div>
             <div className="col-sm-4">{e.nickname}</div>
             <div className="col-sm-2">
               <a className="btn btn-default"
                 onClick={event => this.options(event, e)} >
                 <i className="fa fa-gear text-muted"></i>
                &nbsp;
                Edit
               </a>
             </div>
             
                 {(i != 0 && e.id != this.state.one.id) &&
                 <a className="btn btn-default" 
                    onClick={event => this.remove(event, e)}>
                   <i className="fa fa-close text-muted"></i>
                   &nbsp;
                   Remove
                 </a>}
    
           </div>
                  <br />
                     </div>
         )}

      <a className="btn btn-default" 
                  disabled={this.state.all.length >= 5} 
                  onClick={this.click}>+</a>



        <div className="row"></div>
        <br />
        

        <div className="row">
          <div className="col-sm-12 translate">Invitations</div>
        </div>
        <br />
        {this.state.invites.length == 0 &&
          <div className="row">
            <div className="col-sm-offset-2 col-sm-4">No invitations</div>
          </div>
        }
            {this.state.invites.map(e => 
             <div>
                   <div className="row">
        <div className="col-sm-offset-2 col-sm-4">{e.account.nickname + ' (' + e.author + ')'}</div>

        <div className="col-sm-4">
          <a onClick={event => this.join(event, e)} /* href="#" */
            className="btn btn-info">
            <i className="fa fa-check"></i>
            &nbsp;
            Join
          </a>
          &nbsp;
          <a /* href="#" */ className="btn btn-default" 
            onClick={event => this.decline(event, e)}>
              <i className="fa fa-repeat text-muted"></i>
              &nbsp;
              Decline
          </a>
        </div>
      </div>
      <br />
             </div>
         )}

      </div>
    )
    
  }
  
  decline = (event, e) => {
    $.ajax({
      url: '/invite/delete/' + e.id
    }).then(r => {
      const invites = this.state.invites
      this.setState({
        invites: invites.filter(v => v.id != e.id)
      })
    })
  }
  
  join = (event, e) => {
    // alert(e.account.nickname)
   /* if (this.state.all.find(v => v.id == e.account_id)){
      this.setState({
        text: 'Already exists.'
      })
      return
    } */
    $.ajax({
      url: '/account/join/' + e.account_id
    }).then(r => {
      //document.body.innerHTML = JSON.stringify( r )
      const all = this.state.all
      this.setState({
        all: [...all, r]
      })
      return $.ajax({
        url: '/invite/joined/' + e.id
      })
    }, r => document.body.innerHTML = JSON.stringify( r )
    ).then(r => {
      const invites = this.state.invites
      this.setState({
        invites: invites.filter(v => v.id != e.id)
      })
    }, r => document.body.innerHTML = JSON.stringify( r )
    )
  }
    
  options = (event, e) => {
    // e.preventDefault()
    // e.stopPropagation()
    //alert(e.id)
    /*
    $.ajax({
      url: 'account/select',
      data: {
        id: e.id,
      },
    }).then(r => 
      location.href = '/account/edit'
    ) */
    location.href = '/account/edit/' + e.id
  }
  
  click = e => {
    if (this.state.all.length >= 5){
      return
    }
    $.ajax({
      url: '/account/add',
      data: {
        nickname: 'New Account ' + (this.state.all.length + 1)
      }
    }).then(r => {
     /* $.ajax({
        url: 'account/select',
        data: { id: r.id },
      })
    */
     // alert(JSON.stringify(r))
      
      const all = this.state.all
      const one = this.state.one
      this.setState({
        all: [ ...all, r ],
        one: one || r,
      })
    })
  }
            
  
  remove = (event, e) => {
    $.ajax({
      url: '/account/delete',
      data: {
        id: e.id,
      }
    }).then(r => {
      const all = this.state.all
      this.setState({
        all: all.filter(v => v.id != e.id)
      })
    })
  }
  
}

$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': sessionStorage.token
  }
})

$.ajax({
  url: '/api/accounts'
}).then(r => {
  
  let accounts =  [...document.getElementsByClassName('accounts')].map( e => {
    ReactDOM.render( <Accounts 
                    all={ r.accounts }  
                    one={ r.account }
                    invites={r.invites}
                    />, e) 
  })
})
