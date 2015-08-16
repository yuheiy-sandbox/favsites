var Item = React.createClass({
  render() {
    return (
      <div className="col-xs-6 col-sm-4 col-md-3 col-lg-2 item">
        <a className="item__link" href={this.props.url} target="_blank">
          <p className="item__title">{this.props.title}</p>
          <img className="item__thumb" src={this.props.thumbUrl} alt="" />
        </a>
      </div>
    );
  }
});

var ItemList = React.createClass({
  render() {
    var items = this.props.items.map((item, i) => {
      return (
        <Item title={item.title} url={item.url} thumbUrl={item.thumb_url} key={i} />
      );
    });

    return (
      <div className="container-fluid">
        <div className="row">
          {items}
        </div>

        <hr />
      </div>
    );
  }
});
