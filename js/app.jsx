var Favsites = React.createClass({
  loadItems(pageNum) {
    $.getJSON('items.php', {page: pageNum}).done((json) => {
      this.setState({data: json});
    }).fail(() => {
      console.log('error');
    });
  },

  changePage(id) {
    this.setState({current: id});
    this.loadItems(id + 1);
  },

  getInitialState() {
    return {
      data: {
        items: [],
        page_count: 0
      },
      current: 0
    };
  },

  componentDidMount() {
    this.loadItems(1);
  },

  render() {
    return (
      <div>
        <Header />
        <ItemList items={this.state.data.items} />
        <Footer pageCount={this.state.data.page_count} current={this.state.current} onChange={this.changePage} />
      </div>
    );
  }
});

React.render(<Favsites />, document.body);
