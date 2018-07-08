import React from 'react';

import AboutLink from './AboutLink';
import CitiesLink from './CitiesLink';
import LanguageDropdown from './LanguageDropdown';
import LoginButton from './LoginButton';
import Logo from './Logo';
import MobileLanguageSelect from './MobileLanguageSelect';

class Header extends React.Component {

  constructor(props) {
    super(props);
    this.state = {
      mobileSubMenuHidden: true
    }
  }

  toggleMobileSubMenuHidden() {
    this.setState({
      mobileSubMenuHidden: !this.state.mobileSubMenuHidden
    });
  }

  getMobileSubMenuHiddenClass() {
    return this.state.mobileSubMenuHidden ? " mobile-hidden" : "";
  }

  render() {
    return (
      <div id="navigation-header-content">
        <div className="mobile-header-content">
          <Logo />
          <div className="mobile-menu-toggler">
            <i className="fas fa-bars" onClick={this.toggleMobileSubMenuHidden.bind(this)}></i>
          </div>
          <div className="clearfix"></div>
        </div>
        <div className={"mobile-header-submenu" + this.getMobileSubMenuHiddenClass()}>
          <CitiesLink />
          <AboutLink />
          <MobileLanguageSelect />
          <LoginButton />
          <LanguageDropdown />
        </div>
      </div>
    );
  }
}

export default Header;
