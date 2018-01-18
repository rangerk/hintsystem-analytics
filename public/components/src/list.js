import React from 'react'
import ReactDOM from 'react-dom'
import $ from 'jquery'

import app from './log.js'

import 'whatwg-fetch'


class List extends React.Component {
  
  constructor(props){
    super(props)
        
    /*this.state = { 
      value: props.value,
      columns: props.columns,
      max: props.max,
      accounts: props.accounts,
    }*/
    
    this.state = { 
      value: props.snippets,
      columns: props.columns,
      max: props.max,
      accounts: props.accounts,
      account: props.account,
      url: props.url,
    }
    
    //alert(JSON.stringify(props))
    /*
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': window.token
      }
    })
    */
    
    if (sessionStorage.creating == 1){
      app.log({
        value: 'account created'
      })
      $.ajax({
        url: '/email/welcome'
      })
      sessionStorage.creating = 2
    }
    if (sessionStorage.login == 1){
      $.ajax({
        url: '/tokens/create',
        data: {
          token: sessionStorage.token,
        },
      })
      app.log({
        value: 'login'
      })
      sessionStorage.login = 2
    }
    if (sessionStorage.email == 1){
      $.ajax({
        url: '/email/confirm',
      //  type: 'POST',
       // data: {},
      })
      sessionStorage.email = 2
    }
    /*
    if (!window.login){
      window.login = true
      app.log({ value: 'login' })
      //sessionStorage.token = 'hello'
      
    }
    */
   
   
  }
  
  render() {

    return (
      <div >
      
        <div>
          {this.accounts()}
        </div>
        <br />
      
              <div style={{ display: 'inline-block', minWidth: '100%', width: '' }} >
      
        <div className="panel panel-default" style={{ 
      minWidth: '100%', width: '100%'
      }} >
          <div className="panel-heading translate">Hint List</div>
          <div className="panel-body">{this.list()}</div>
        </div>

{/* <div className="panel panel-default" style={{ 
      minWidth: '100%', width: '100%'
      }} >
          <div className="panel-heading translate">Hint List</div>
          <div className="panel-body">{this.snippets()}</div>
        </div> */}

        <div className="panel panel-default">
          <div className="panel-heading translate">Instructions</div>
          <div className="panel-body text-muted">{this.instructions()}</div>
        </div>

        <div className="panel panel-default">
          <div className="panel-heading translate">Preview</div>
          <div className="panel-body">{this.preview()}</div>
        </div>
</div>
      </div>
    )
  }
  
  sel = (event, e) => {
    //alert(e.nickname)
    this.setState({
      account: e,
      value: null,
    })
  }
  
  accounts = () => {
    return (
      <div>
      
     {/* <div style={{ position: 'fixed' }} > */}
     {/* <div style={{ position: 'relative' }} > */}
        
        <div className="row">
      
        <div className="col-sm-1">
        <a href="/account/edit" 
          className="btn btn-default ">
          <i className="fa fa-gear text-muted"></i>
        </a>
        </div>
      
      {/* <div className="col-sm-10"> */}
        <div className="col-sm-6">
        <div className="dropdown">
            <a className="dropdown-toggle btn btn-default" data-toggle="dropdown" role="button" aria-expanded="false">
              <span>{this.state.account.nickname}</span>
              &nbsp;
              <span className="caret"></span>
            </a>
            <ul className="dropdown-menu" role="menu">
              {this.state.accounts.map(e => 
                <li>
                  <a href={'/account/select?id=' + e.id} onClick={event => this.sel(event, e)} >
                    <i className="fa fa-btn fa-sign-in"></i>
                    &nbsp;
                    {e.nickname}
                  </a>
                </li>
              )}
            </ul>
        </div>
        </div>

        <div className="col-sm-1">
        <a href={this.state.url + '/?_csrf=' + window.token} target="_blank"
            className="btn btn-default">
            Drag & Drop Hint Placement (beta)
        </a> 
        
        </div>

        </div>

     {/* </div>
      <div className="row"></div><br />
      <div className="row"></div><br /> */}
      </div>
    )
  }
  
  preview = () => {
    
    return (
      <div>
      { this.state.value.map( e => 
          <div className="alert alert-info" style={{ minHeight: '100px' }}>
            <div className="_hintsystem" data-v1="hello"
              id={ e.account_id + '-' + e.num }>hint loading...</div>
          </div>
      )}
      </div>
    )
  }
  
  instructions = () => {
    const s = this.state.value
    return (
      <div>
        <ol>
          <li>
            <span className="translate">Copy and paste the following snippet into your site's html before the</span>
            &nbsp; 
            <span className="label label-info">{'</body>'}</span>
            &nbsp;
            <span className="translate">tag</span>.
            &nbsp;
            <span className="label label-success">
              {'<script src="' + location.host + /* '/api.js' */ '/hs.js' + '"></script>'}
            </span>
          </li>
      {/* <li>
            { s.length > 0 && <span className="label label-success">{ s[0].snippet }</span> }
          </li> */}
          <li>
            <span className="translate">For each hint, copy and paste it's snippet where ever you'd like it to appear on your site</span>.
          </li>
          <li>
            <span className="translate">Use</span>
            &nbsp;
            <a href="http://hintsystem.com">hintsystem.com</a>
            &nbsp;
            <span className="translate">to edit and manage your hints</span>.
          </li>
        </ol>
      </div>
    )
  }
  
  snippets = () => {
    const s = { 
      minWidth: '100px',
      maxWidth: '100px', 
      wordBreak: 'break-all',
    }
    return (
      <div className="text-muted">
      <div className="row">
        <div className="col-sm-2" style={ s }>Edit</div>
        <div className="col-sm-2" style={ s }>Remove</div>
        <div className="col-sm-1" style={ s }>Id</div>
      
        {this.state.columns.filter(e => e != 'Id').map(e => 
              <div style={ s } className="translate col-sm-2">{ e }</div>
            )}
      </div>

      {this.state.value.map(e => 
        <div key={e.id} className="row">
          <div className="col-sm-6">

          <div className="col-sm-2" style={ s }><a className="btn btn-default">Edit</a></div>
          <div className="col-sm-2" style={ s }><a className="btn btn-default">Remove</a></div>
          <div className="col-sm-1" style={ s }>{e.num}</div>
          <div className="col-sm-2" style={ s }><input className="form-control" value={e.nickname} /></div>
          <div className="col-sm-2" style={ s }>{e.content}</div>
                    
          {this.column('On/Off') && <div className="col-sm-1" style={ s }>{ e.on }</div>}
          {this.column('Author') && <div className="col-sm-1" style={ s }>{ e.author }</div>}
          {this.column('Created') && <div className="col-sm-1" style={ s }>{ e.created_at }</div>}
          {this.column('Modified') && <div className="col-sm-1" style={ s }>{ e.updated_at }</div>}
          {this.column('Template') && <div className="col-sm-1" style={ s }>{ e.template }</div>}
          </div>
          <div className="col-sm-6">
          {this.column('Activation') && <div className="col-sm-1" style={ s }>{ e.activation }</div>}
          {this.column('Icon') && <div className="col-sm-1" style={ s }><img src={ e.icon } /></div>}
          {this.column('Header') && <div className="col-sm-1" style={ s }>{ e.header }</div>}
          {this.column('Footer') && <div className="col-sm-1" style={ s }>{ e.footer }</div>}

          {this.column('Voting') && <div className="col-sm-1" style={ s }>{ e.voting }</div>}
          {this.column('Votes') && <div className="col-sm-1" style={ s }>{ e.votes.split('|')[0] }<i className="fa fa-thumbs-o-up"></i> | { e.votes.split('|')[1] } <i className="fa fa-thumbs-o-down"></i></div>}
          {this.column('Comments') && <div className="col-sm-1" style={ s }>{ e.comments }</div>}
          {this.column('Tags') && <div className="col-sm-1" style={ s }>{ e.tags }</div>}
          {this.column('Analytics') && <div className="col-sm-1" style={ s }>{ e.analytics }</div>}

          <div className="col-sm-2" style={ s }>{e.snippet}</div>
          </div>
        </div>
      )}
      </div>
    )
  }
  
  list = () => {
  //render() {
    const s = { 
      minWidth: '100px',
      maxWidth: '100px', 
      wordBreak: 'break-all',
      border: 'none',
      color: 'rgba(128, 128, 128, 1)'
    }
    const s2 = {
      // color: 'white',
      //minWidth: '50px',
     // maxWidth: '50px', 
      wordBreak: 'break-all',
      border: 'none',
    }
    return (
      <div>
      {/* <div className="table-responsive"> */}
      <div className="table-responsive"> 
        <table className="table table-striped snippet-table">
          <tbody>
          <tr className="info">
            <th style={ s2 }></th>
           {/*  <th style={ s } ></th> */}
      <th style={ s2 }></th>
            <th className="translate" style={ s }>Id</th>
            {/*<th style={ s } className="translate">Nickname</th>
            <th style={ s } className="translate">Content</th> */}
            
            {this.state.columns.filter(e => e != 'Id').map(e => 
              <th style={ s } className="translate">{ e }</th>
            )}
      
            {/* <th className="translate">Snippet</th> */}
        {/* <th className="translate">Edit</th>
            <th className="translate">Delete</th> */}
        {/* <th></th>
            <th></th> */}
          </tr>
          
            
         {this.state.value.map(e => 
           <tr key={e.id} className="default">

              <td style={ s2 }>
                <a href={'/snippet/edit/' + e.id} className="btn btn-default">
                               {/* <i className="fa fa-btn fa-edit text-muted"></i>Edit */}
                               {/* <i className="fa fa-edit text-muted"></i> */}
                               <i className="fa fa-edit text-success"></i> 
                               &nbsp;
                               <span className="text-muted" >Edit</span>
                </a>
             {/*  </td> */}
                               </td>
                               <td style={ s2 }>
                               
            {/*  <td style={ s } > */}
                           {/*    &nbsp; */}
                  
               {/* <a style={{ display: e.deleting ? 'none' : '' }} */}
                             {/*  <a */}
                 <a 
                  /* style={{ display: e.deleting ? 'none' : '' }} */
                  onClick={event => this.remove(event, e)} 
                  className="btn btn-default"
                >
                    {/* <i className="fa fa-btn fa-repeat text-muted"></i>Remove */}
{/* <i className="fa fa-trash text-danger"></i> */}
<i className="fa fa-close text-danger"></i>
           &nbsp;
                   <span className="text-muted" >Remove</span>
                </a>
&nbsp;
{/* <div style={{ position: 'absolute', display: e.deleting ? 'block' : 'none' }} > */}
           <div style={{ 
            position: 'absolute', 
            opacity: e.deleting ? '1' : '0' ,
                       /* transition: 'opacity 0.1s', */
transition: 'opacity 1s',
                       float: 'left',
                       display: 'inline-block'
           }} > 
                  <button type="button" onClick={event => this.remove(event, e)} className="btn btn-danger">
                    {/* <i className="fa fa-btn fa-check"></i> */}
                   {/* <i className="fa fa-check"></i> */}
{/* &nbsp; */}
{/* Delete */}
Remove

                  </button>
                  &nbsp;
                  <button type="button" onClick={event => this.cancel(event, e)} className="btn btn-default">
                    {/* <i className="fa fa-btn fa-close"></i> */}
{/* <i className="fa fa-close text-muted"></i> */}
Cancel
                 </button>
                </div>

                

              </td> 
                               
              <td className="table-text" style={ s }>{ e.num }</td>
              {this.column('Nickname') && 
                <td className="table-text" style={ s } >
                <div onMouseEnter={this.enter} onMouseLeave={this.leave}
                  onClick={this.click} 
                  onKeyUp={event => this.save(event, e, 1)}
                  onBlur={this.blur}
                  style={{ 
                         /* boxShadow: '2px 2px 5px grey', */
                         boxShadow: '0px 0px 2px grey', 
                         borderRadius: '2px',
                         /* transition: 'box-shadow 1s', */
                         transition: 'box-shadow 0.5s', 
                        }} >
                    { e.nickname }
                </div>
           
                </td>}
              {this.column('Content') && <td className="table-text"
                  style={ s }
                  /* onClick={this.click} 
                  onKeyUp={event => this.save(event, e, 2)} 
                  onKeyDown={event => this.save(event, e, 2)} 
                  onBlur={this.blur} */
                ><div onMouseEnter={this.enter} onMouseLeave={this.leave}
                  onClick={this.click} 
                  onKeyUp={event => this.save(event, e, 2)} 
                  onBlur={this.blur}
                  style={{ 
                         /*"boxShadow: '2px 2px 5px grey', */
                         boxShadow: '0px 0px 2px grey',
                         borderRadius: '2px',
                        /* transition: 'box-shadow 1s', */
                         transition: 'box-shadow 0.5s', 
                        }} >
                     { e.content }
                 </div></td>}
                  
              {this.column('On/Off') && <td className="table-text" style={ s }>{ e.on }</td>}
              {this.column('Author') && <td className="table-text" style={ s }>{ e.author }</td>}
              {this.column('Created') && <td className="table-text" style={ s }>{ e.created_at }</td>}
              {this.column('Modified') && <td className="table-text" style={ s }>{ e.updated_at }</td>}
              {this.column('Template') && <td className="table-text" style={ s }>{ e.template }</td>}
              
              {this.column('Activation') && <td className="table-text" style={ s }>{ e.activation }</td>}
              {this.column('Icon') && <td className="table-text" style={ s }><img src={ e.icon } /></td>}
              {this.column('Header') && <td className="table-text" style={ s }>{ e.header }</td>}
              {this.column('Footer') && <td className="table-text" style={ s }>{ e.footer }</td>}
              
              {this.column('Voting') && <td className="table-text" style={ s }>{ e.voting }</td>}
              {this.column('Votes') && <td className="table-text" style={ s }>{ e.votes.split('|')[0] }<i className="fa fa-thumbs-o-up"></i> | { e.votes.split('|')[1] } <i className="fa fa-thumbs-o-down"></i></td>}
              {this.column('Comments') && <td className="table-text" style={ s }>{ e.comments }</td>}
              {this.column('Tags') && <td className="table-text" style={ s }>{ e.tags }</td>}
              {this.column('Analytics') && <td className="table-text" style={ s }>{ e.analytics }</td>}
              
              <td className="table-text" style={ s }><div>{ e.snippet }</div></td>
      
              {/* <td>
              <a href={'/snippet/edit/' + e.id} className="btn btn-info">
                <i className="fa fa-btn fa-edit"></i>
              </a>
              </td> */}
      
              {/* <td>
               
                <button style={{ display: e.deleting ? 'none' : 'block' }} type="button" 
                  onClick={event => this.remove(event, e)} 
                  className="btn btn-danger"

                >
                  <i className="fa fa-btn fa-trash"></i>X
                </button>
                  
                <div style={{ position: 'absolute', display: e.deleting ? 'block' : 'none' }} >
                <button type="button" onClick={event => this.remove(event, e)} className="btn btn-success">
                  <i className="fa fa-btn fa-check"></i> */}
               {/* <span className="translate">Delete?</span> */}
               {/* </button>
                <button type="button" onClick={event => this.cancel(event, e)} className="btn btn-default">
                  <i className="fa fa-btn fa-close"></i> */}
               {/* <span className="translate">Don't</span> */}
               {/* </button>
                </div>
                
              </td> */}
           </tr>
         )}
      
          </tbody>
        </table>
        </div>
          
        <button type="submit" 
        /* className={this.state.value.length >= 42 ? 'btn btn-default disabled' : 'btn btn-default' } */
               /* disabled={this.state.value.length >= 42} */
          className={this.state.value.length >= this.state.max ? 'btn btn-default disabled' : 'btn btn-default' } 
          disabled={this.state.value.length >= this.state.max}
          title={this.state.value.length >= this.state.max ? 'Maximum number of hints for this account' : ''}
          onClick={this.add} >
          <i className="fa fa-btn fa-plus text-success"></i>
          <span className="translate">Add</span>
        </button>
      </div>
    )
  }
               
  enter = e => {
    // e.target.style.boxShadow = '2px 2px 10px blue'
    e.target.style.boxShadow = '0px 0px 4px blue'
    //e.target.style.zoom = '1.1'
    //e.target.style.borderRadius = '5px'
  }
  
  leave = e => {
    // e.target.style.boxShadow = '2px 2px 5px grey'
    e.target.style.boxShadow = '0px 0px 2px grey'
    //e.target.style.zoom = '1'
  }
  
  column = v => {
    return this.state.columns.find(e => e == v)
  }
  
  blur = e => {
    e.target.contentEditable = false
    e.target.isEditing = false
  }
  
  click = e => {
    //alert(this.state.value)
    if (!e.target.isEditing){
      e.target.isEditing = true
      e.target.contentEditable = true
      this.select(e.target)
    } else {
      /*e.target.blur()
      e.target.focus()*/
    }
  }
  
  add = e => {
    const v = this.state.value
    /*
    const m = v.reduce((s = 0, e) => s > e.num ? s : e.num) + 1
    const u = '0'.repeat(5 - this.props.user.length) + this.props.user
    const c = '0'.repeat(6 - m.toString().length) + m
    */

    $.ajax({
      url: 'snippet', 
      type: 'POST',
      data: {content: 'New content'}
    }).then(r => {
      app.log({ 
        //value: 'add',
        value: 'hint created',
        snippet_id: r.id,
      })
      this.setState({
        value: [
          ...v, r
         /* {
            num: v.reduce((s = 0, e) => s > e.num ? s : e.num) + 1,
            nickname: 'New nick',
            content: 'New hint',
            snippet: `<div class="hs" id="${u}-${c}"></div>`
          } */
        ]
      }), e => alert(JSON.stringify(e))
    }).catch(e => alert(JSON.stringify(e)))
  }
    
  cancel = (event, snippet) => {
    event.preventDefault()
    event.stopPropagation()
    const v = this.state.value
      snippet.deleting = false
      this.setState({
        value: v.map(e => { return e.id == snippet.id ? snippet : e })
      })
  }
  
  remove = (event, snippet) => {
    event.preventDefault()
    event.stopPropagation()
    const v = this.state.value
    if (!snippet.deleting) {
      snippet.deleting = true
      this.setState({
        value: v.map(e => { return e.id == snippet.id ? snippet : e })
      })
      return
    }
    

        
    $.ajax({
      url: '/snippet/' + snippet.id, 
      type: 'DELETE'
    }).then(r => {

      this.setState({
        value: v.filter(e => e.id !== snippet.id)
      }) //, e => e //alert(JSON.stringify(e))
      
      app.log({
        //value: 'remove',
        value: 'hint deleted',
        snippet_id: snippet.id,
      })
            
    }).catch(e => alert(JSON.stringify(e)))
  }
  
  select = e => {
    if (window.getSelection()){
      const r = document.createRange();
      r.selectNodeContents(e);
      window.getSelection().removeAllRanges();
      window.getSelection().addRange(r);
      // return r;
    }

    if (document.selection){
      var r = document.body.createTextRange();
      r.moveToElementText(e);
      r.select();
      // return r;
    }
  }
  
  save = (event, e, t) => {
    if (String.fromCharCode( event.keyCode || event.charCode ) == '\r'){
      event.target.blur()
    }
    
    /*if (this.request) {
      this.request.abort()
    }*/

    if (t == 1) {
      e.nickname = event.target.textContent
    }
    if (t == 2) {
      e.content = event.target.textContent
    }
    // alert(JSON.stringify(event.target.textContent))

    this.request = $.ajax({
      url: '/snippet',
      type: 'PUT',
      data: { id: e.id, content: e.content, nickname: e.nickname }
    }).then(r => {
        //alert(JSON.stringify(r))
        //const v = this.state.value
        //this.setState({ value: v.map(elem => elem.id == r.id ? r : elem)})
        //alert('hello')
        document.getElementById(e.id).innerHTML = e.content
        app.log({
          value: 'hint changed',
          snippet_id: e.id
        })
      }, r => alert(JSON.stringify(r))
      //r => updateSnippet(e.id, e.content)
      //r => r 
     // r => this.setState(v => { value: v.map(elem => elem.id == r.id ? r : elem)})
      // , err => alert(JSON.stringify(err))
    )
      /* .catch(err => alert(JSON.stringify(err))) */
    
  }
  
}

$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': sessionStorage.token
  }
})
               
$.ajax({
  url: '/snippets/all'
}).then(r => {
  //alert(JSON.stringify(r))
  ReactDOM.render(
      <List
        snippets={r.snippets}
        accounts={r.accounts}
        columns={r.columns.split(',')}
        max={r.max}
        account={r.account}
        url={r.url}
      />, 
      document.getElementById('list')
  )
})

/*
let list = [...document.getElementsByClassName('list')].map( e => 
ReactDOM.render(<List 
                value={JSON.parse(e.getAttribute('data-value'))}
                columns={e.getAttribute('data-columns').split(',')}
                max={e.getAttribute('data-max')}
                accounts={e.getAttribute('data-accounts')}
/>, e))
*/


