<?php
namespace Application\Sonata\UserBundle\Form\Type;
use Sonata\UserBundle\Form\Type\SecurityRolesType as BaseRolesType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Sonata\AdminBundle\Admin\Pool;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class SecurityRolesType extends BaseRolesType{
    public function __construct(Pool $pool, $supportedRoles)
    {
        $this->supportedRoles = $supportedRoles;
        $this->pool = $pool;
        parent::__construct($pool);
    }
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        ChoiceType::setDefaultOptions($resolver);

        $roles = array();
        $rolesReadOnly = array();

        $securityContext = $this->pool->getContainer()->get('security.context');


        if ($securityContext->getToken()) {
            // get roles from the Admin classes
            foreach ($this->pool->getAdminServiceIds() as $id) {
                try {
                    $admin = $this->pool->getInstance($id);
                } catch (\Exception $e) {
                    continue;
                }

                $isMaster = $admin->isGranted('MASTER');
                $securityHandler = $admin->getSecurityHandler();
                // TODO get the base role from the admin or security handler
                $baseRole = $securityHandler->getBaseRole($admin);

                foreach ($admin->getSecurityInformation() as $role => $permissions) {
                    $role = sprintf($baseRole, $role);

                    if ($isMaster) {
                        // if the user has the MASTER permission, allow to grant access the admin roles to other users
                        $roles[$role] = $role;
                    } elseif ($securityContext->isGranted($role)) {
                        // although the user has no MASTER permission, allow the currently logged in user to view the role
                        $rolesReadOnly[$role] = $role;
                    }
                }
            }

            // get roles from the service container
            foreach ($this->pool->getContainer()->getParameter('security.role_hierarchy.roles') as $name => $rolesHierarchy) {

                if (($securityContext->isGranted($name) || $isMaster)) {
                    if(in_array($name,$this->supportedRoles,true)){
                        $roles[$name] = $name;
                    }

                    foreach ($rolesHierarchy as $role) {
                        if (!isset($roles[$role])&&in_array($role,$this->supportedRoles,true)) {
                            
                            $roles[$role] = $role;
                        }
                    }
                }
            }
        }

        $resolver->setDefaults(array(
                                    'choices' => function (Options $options, $parentChoices) use ($roles) {
                                        return empty($parentChoices) ? $roles : array();
                                    },

                                    'read_only_choices' => function (Options $options) use ($rolesReadOnly) {
                                        return empty($options['choices']) ? $rolesReadOnly : array();
                                    },

                                    'data_class' => null
                               ));
    }
}
 