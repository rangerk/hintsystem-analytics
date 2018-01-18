import React from 'react'
import ReactDOM from 'react-dom'
import $ from 'jquery'


class Tags extends React.Component {
    constructor(props) {
        super(props)
        this.state = { 
            name: props.name, 
            value: props.value.split(',').filter((e) => e !== ''),
            typed: '',
            auto: [],
        }
        
        this.deleteTag = this.deleteTag.bind(this)
        this.onType = this.onType.bind(this)
        this.deleteOver = this.deleteOver.bind(this)
        this.deleteOut = this.deleteOut.bind(this)
    }
  
    render() {
       const v = this.state.value
       return (
            <div>
                <div className="col-sm-1 text-muted translate">Tags</div>
                <div className="col-sm-11">

            {v.map((s, i) => 
                <span style={{ transition: 'opacity 1s, transform 1s, max-width 1s', 
                             opacity: s.deleted ? '0' : '1',
                             transform: s.deleted ? 'scale(0.1, 1)' : 'scale(1, 1)',
                             display: 'inline-block',
                             maxWidth: s.deleted ? '0px' : '100px'
                            }}>
                <span className="label label-info" 
                    style={{ borderRadius: '20px', 
                             marginLeft: '2px',
                             marginRight: '1px' }} 
                    onClick={ (e) => this.deleteTag(e, i) }
                    onMouseOver={this.deleteOver}
                    onMouseOut={this.deleteOut}
                >x</span>
                <span className="label label-default">{ s.deleted || s }</span>
                </span>
          )}
          {this.state.auto.map(
            e => e.map( e => 
            <span>
            &nbsp;
            <span className="label label-success"
              onClick={event => this.complete(event, e)}
            >{e}</span> 
            </span>             
            ))}
  
                </div>
                <div className="row"></div><br />
                <div className="col-sm-8">
                    <input 
                        /*value={this.state.typed}*/ 
                        type="text" 
                        className="form-control" name="" 
                        /*onChange={this.onType} */
                        onKeyDown={this.add}
                        onKeyUp={this.auto}
                        />
                </div>
                <div className="col-sm-4"></div>
                <input type="hidden" style={{ display: 'none'}} name={this.state.name} value={this.all()} />
          </div>
        )
    }
  
    deleteTag(e, i){
        $('.disabled').removeClass('disabled')
        let value = this.state.value.map((curr, index) => 
                                         index != i ? curr : {deleted: curr} )
        this.setState({value: value})
    }

    onType(e){
        this.setState({typed: e.target.value})
    }

    all(){
        let r = this.state.value.filter((e) => !e.deleted).join(',')
        let typed = this.state.typed
        if (typed !== ''){
            r += ',' + typed
        }
        return r.split(',').map((e) => e.trim()).filter((e) => e !== '').join(',')
    }

    deleteOver(e){
        e.target.className = 'label label-warning'
    }

    deleteOut(e){
        e.target.className = 'label label-info'
    }

    add = e => {
      if ('\r' == String.fromCharCode( e.keyCode || e.charCode) || 
         (e.keyCode || e.charCode) == 188){
        
          const v = this.state.value
          this.setState({
            value: [ ...v, e.target.value ].map(e => e.trim()).filter(e => e != '')
          })
          e.target.value = ''
          e.preventDefault()
        
      }
    }
    
    auto = e => {
      if (e.target.value == ''){
        this.setState({ auto: [] })
      } else {
        const typed = e.target.value
        fetch('/auto?tags=' + e.target.value, {
          headers: { 
            'X-CSRF-TOKEN': window.token,
           // 'Content-Type': 'application/json'
          },
         /* body: JSON.stringify({
            tags: ''
          }),*/
        }).then(r => r.json(), r => alert(r)).then(r => {
           // alert(v)
            this.setState({
              //auto: [ '1', '2', '3' ]
              auto: r.map( v => 
                v.split(',').filter(f => f.indexOf(typed) >= 0))
            })
        })
      }
    }
    
    complete = (e, p) => {
      const v = this.state.value
      this.setState({
        value: [ ...v, p ]
      })
    }
}

let tags = [...document.getElementsByClassName('tags')].map( e => 
ReactDOM.render(<Tags name={e.id} value={e.innerHTML} />, e))
