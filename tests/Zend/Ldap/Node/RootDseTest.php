<?php
/**
 * Zend Framework
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://framework.zend.com/license/new-bsd
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@zend.com so we can send you a copy immediately.
 *
 * @category   Zend
 * @package    Zend_Ldap
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */

/**
 * Zend_Ldap_OnlineTestCase
 */
require_once dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'OnlineTestCase.php';

/**
 * @category   Zend
 * @package    Zend_Ldap
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Ldap
 * @group      Zend_Ldap_Node
 */
class Zend_Ldap_Node_RootDseTest extends Zend_Ldap_OnlineTestCase
{
    public function testLoadRootDseNode()
    {
        $root1 = $this->_getLdap()->getRootDse();
        $root2 = $this->_getLdap()->getRootDse();

        $this->assertEquals($root1, $root2);
        $this->assertSame($root1, $root2);
    }

    public function testSupportCheckMethods()
    {
        $root = $this->_getLdap()->getRootDse();

        $this->assertIsBool($root->supportsSaslMechanism('GSSAPI'));
        $this->assertIsBool($root->supportsSaslMechanism(array('GSSAPI', 'DIGEST-MD5')));
        $this->assertIsBool($root->supportsVersion('3'));
        $this->assertIsBool($root->supportsVersion(3));
        $this->assertIsBool($root->supportsVersion(array('3', '2')));
        $this->assertIsBool($root->supportsVersion(array(3, 2)));

        switch ($root->getServerType()) {
            case Zend_Ldap_Node_RootDse::SERVER_TYPE_ACTIVEDIRECTORY:
                $this->assertIsBool($root->supportsControl('1.2.840.113556.1.4.319'));
                $this->assertIsBool($root->supportsControl(array('1.2.840.113556.1.4.319',
                    '1.2.840.113556.1.4.473')));
                $this->assertIsBool($root->supportsCapability('1.3.6.1.4.1.4203.1.9.1.1'));
                $this->assertIsBool($root->supportsCapability(array('1.3.6.1.4.1.4203.1.9.1.1',
                    '2.16.840.1.113730.3.4.18')));
                $this->assertIsBool($root->supportsPolicy('unknown'));
                $this->assertIsBool($root->supportsPolicy(array('unknown', 'unknown')));
                break;
            case Zend_Ldap_Node_RootDse::SERVER_TYPE_EDIRECTORY:
                $this->assertIsBool($root->supportsExtension('1.3.6.1.4.1.1466.20037'));
                $this->assertIsBool($root->supportsExtension(array('1.3.6.1.4.1.1466.20037',
                    '1.3.6.1.4.1.4203.1.11.1')));
                break;
            case Zend_Ldap_Node_RootDse::SERVER_TYPE_OPENLDAP:
                $this->assertIsBool($root->supportsControl('1.3.6.1.4.1.4203.1.9.1.1'));
                $this->assertIsBool($root->supportsControl(array('1.3.6.1.4.1.4203.1.9.1.1',
                    '2.16.840.1.113730.3.4.18')));
                $this->assertIsBool($root->supportsExtension('1.3.6.1.4.1.1466.20037'));
                $this->assertIsBool($root->supportsExtension(array('1.3.6.1.4.1.1466.20037',
                    '1.3.6.1.4.1.4203.1.11.1')));
                $this->assertIsBool($root->supportsFeature('1.3.6.1.1.14'));
                $this->assertIsBool($root->supportsFeature(array('1.3.6.1.1.14',
                    '1.3.6.1.4.1.4203.1.5.1')));
                break;
        }
    }

    public function testGetters()
    {
        $root = $this->_getLdap()->getRootDse();

        $this->assertIsArray($root->getNamingContexts());
        $this->assertIsArray($root->getSubschemaSubentry());

        switch ($root->getServerType()) {
            case Zend_Ldap_Node_RootDse::SERVER_TYPE_ACTIVEDIRECTORY:
                $this->assertIsString($root->getConfigurationNamingContext());
                $this->assertIsString($root->getCurrentTime());
                $this->assertIsString($root->getDefaultNamingContext());
                $this->assertIsString($root->getDnsHostName());
                $this->assertIsString($root->getDomainControllerFunctionality());
                $this->assertIsString($root->getDomainFunctionality());
                $this->assertIsString($root->getDsServiceName());
                $this->assertIsString($root->getForestFunctionality());
                $this->assertIsString($root->getHighestCommittedUSN());
                $this->assertIsBool($root->getIsGlobalCatalogReady());
                $this->assertIsBool($root->getIsSynchronized());
                $this->assertIsString($root->getLdapServiceName());
                $this->assertIsString($root->getRootDomainNamingContext());
                $this->assertIsString($root->getSchemaNamingContext());
                $this->assertIsString($root->getServerName());
                break;
            case Zend_Ldap_Node_RootDse::SERVER_TYPE_EDIRECTORY:
                $this->assertIsString($root->getVendorName());
                $this->assertIsString($root->getVendorVersion());
                $this->assertIsString($root->getDsaName());
                $this->assertIsString($root->getStatisticsErrors());
                $this->assertIsString($root->getStatisticsSecurityErrors());
                $this->assertIsString($root->getStatisticsChainings());
                $this->assertIsString($root->getStatisticsReferralsReturned());
                $this->assertIsString($root->getStatisticsExtendedOps());
                $this->assertIsString($root->getStatisticsAbandonOps());
                $this->assertIsString($root->getStatisticsWholeSubtreeSearchOps());
                break;
            case Zend_Ldap_Node_RootDse::SERVER_TYPE_OPENLDAP:
                $this->_assertNullOrString($root->getConfigContext());
                $this->_assertNullOrString($root->getMonitorContext());
                break;
        }
    }

    protected function _assertNullOrString($value)
    {
        if ($value === null) {
            $this->assertNull($value);
        } else {
            $this->assertIsString($value);
        }
    }

    /**
     */
    public function testSetterWillThrowException()
    {
        $this->expectException(\BadMethodCallException::class);

        $root              = $this->_getLdap()->getRootDse();
        $root->objectClass = 'illegal';
    }

    /**
     */
    public function testOffsetSetWillThrowException()
    {
        $this->expectException(\BadMethodCallException::class);

        $root                = $this->_getLdap()->getRootDse();
        $root['objectClass'] = 'illegal';
    }

    /**
     */
    public function testUnsetterWillThrowException()
    {
        $this->expectException(\BadMethodCallException::class);

        $root = $this->_getLdap()->getRootDse();
        unset($root->objectClass);
    }

    /**
     */
    public function testOffsetUnsetWillThrowException()
    {
        $this->expectException(\BadMethodCallException::class);

        $root = $this->_getLdap()->getRootDse();
        unset($root['objectClass']);
    }
}
