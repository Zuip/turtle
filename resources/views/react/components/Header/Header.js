import React from 'react';

import AboutLink from './AboutLink';
import CitiesLink from './CitiesLink';
import LanguageDropdown from './LanguageDropdown';
import LoginButton from './LoginButton';
import Logo from './Logo';
import MobileLanguageSelect from './MobileLanguageSelect';
import MobileLogoutButton from './MobileLogoutButton';
import MobileUser from './MobileUser';
import MobileUserMenuToggler from './MobileUserMenuToggler';
import UserDropdown from './UserDropdown';

class Header extends React.Component {

  constructor(props) {
    super(props);
    this.state = {
      mobileLinksMenuHidden: true,
      mobileUserMenuHidden: true
    }
  }

  toggleMobileLinksMenuHidden() {
    this.setState({
      mobileLinksMenuHidden: !this.state.mobileLinksMenuHidden,
      mobileUserMenuHidden: true
    });
  }

  toggleMobileUserMenuHidden() {
    this.setState({
      mobileLinksMenuHidden: true,
      mobileUserMenuHidden: !this.state.mobileUserMenuHidden
    });
  }

  getMobileLinksMenuHiddenClass() {
    return this.state.mobileLinksMenuHidden ? " mobile-hidden" : "";
  }

  getMobileUserMenuHiddenClass() {
    return this.state.mobileUserMenuHidden ? " mobile-hidden" : "";
  }

  render() {
    return (
      <div id="navigation-header-content">
        <div className="mobile-header-content">
          <Logo />
          <div className="mobile-menu-toggler">
            <i className="fas fa-bars" onClick={this.toggleMobileLinksMenuHidden.bind(this)}></i>
          </div>
          <MobileUserMenuToggler toggleMenu={this.toggleMobileUserMenuHidden.bind(this)} />
          <div className="clearfix"></div>
        </div>
        <div className={"mobile-header-submenu" + this.getMobileLinksMenuHiddenClass()}>
          <CitiesLink />
          <AboutLink />
          <MobileLanguageSelect />
          <LoginButton />
          <UserDropdown />
          <LanguageDropdown />
        </div>
        <div className={"mobile-header-submenu" + this.getMobileUserMenuHiddenClass()}>
          <MobileUser />
          <MobileLogoutButton />
        </div>
      </div>
    );
  }
}

export default Header;
