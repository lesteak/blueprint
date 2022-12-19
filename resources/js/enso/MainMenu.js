export default {
  data() {
    return {
      menuVisible: false,
      pageTop: 0,
      lastScroll: 0,
      header: null,
    };
  },
  mounted () {
    this.header = document.getElementById('nav-bar');
    window.addEventListener('scroll', () => {
      if (window.pageYOffset >= 100) {
          let currentScroll = window.pageYOffset;
          if (!this.menuVisible) {
              if (currentScroll - this.lastScroll > 0) {
                  this.header.classList.add('scroll-down');
                  this.header.classList.remove('scroll-up');
                  this.header.style.cssText = ``;
              } else {
                  // scrolled up -- header show
                  this.header.classList.add('scroll-up');
                  this.header.classList.remove('scroll-down');
      
                  this.header.style.cssText = `position:fixed;top:0;z-index:100;`;
              }
          }
          this.lastScroll = currentScroll;
      }
  });
  },
  methods: {
    toggleMenu() {
      this.menuVisible = !this.menuVisible;
      const mobile_menu = document.getElementById("mobile-nav");
      mobile_menu.classList.toggle("hidden");
  
      if (this.menuVisible) {
          document.body.style.top = `-${window.pageYOffset}px`;
          this.pageTop = window.pageYOffset;
          document.body.classList.add('fixed');
      } else {
          document.body.classList.remove('fixed');
          document.body.style.cssText = '';
          window.scrollTo(0, this.pageTop);
      }
    },
  },
  render() {
    return this.$scopedSlots.default({
      menuVisible: this.menuVisible,
      toggleMenu: this.toggleMenu,
    });
  },
};
