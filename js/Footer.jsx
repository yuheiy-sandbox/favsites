var Page = React.createClass({
  _onChange(e) {
    e.preventDefault();
    this.props.onChange(this.props.id)
  },

  render() {
    return (
      <li className={this.props.className}><a href="#" onClick={this._onChange}>{this.props.children}</a></li>
    );
  }
});

var Pagination = React.createClass({
  _onChange(id) {
    this.props.onChange(id);
  },

  render() {
    var current = this.props.current,
        pageCount = this.props.pageCount,
        rangePages = [];
    for (var i = 0; i < pageCount; i++) {
      if (current === i) {
        rangePages.push(<Page className="active" id={i} key={i} onChange={this._onChange}>{i + 1}</Page>);
      } else {
        rangePages.push(<Page className="" id={i} key={i} onChange={this._onChange}>{i + 1}</Page>);
      }
    }

    return (
      <div className="text-center">
        <ul className="pagination pagination-lg">
          <Page className={current ? "" : "disabled"} id={current ? current - 1 : 0} onChange={this._onChange}>&laquo;</Page>
          {rangePages}
          <Page className={pageCount - 1 > current ? "" : "disabled"} id={pageCount - 1 > current ? current + 1 : current} onChange={this._onChange}>&raquo;</Page>
        </ul>
      </div>
    );
  }
});

var Footer = React.createClass({
  _onChange(id) {
    this.props.onChange(id);
  },

  render() {
    return (
      <footer className="container">
        <Pagination pageCount={this.props.pageCount} current={this.props.current} onChange={this._onChange} />
        <p className="text-center">© 2015 <a href="/">Yuhei Yasuda</a> All Rights Resered.</p>
      </footer>
    );
  }
});
