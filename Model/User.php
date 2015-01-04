<?php
namespace Landmarx\Bundle\UserBundle\Model;

class User extends \FOS\UserBundle\Model\User
{
    /**
     * id
     * @var integer
     */
    protected $id;

    /**
     * First name
     * @var string 
     */
    protected $firstname;

    /**
     * Last name
     * @var string 
     */
    protected $lastname;

    /**
     * Facebook id
     * @var string
     */
    protected $facebookId = null;

    /**
     * Google id
     * @var string
     */
    protected $googleId = null;

    /**
     * Linkedin id
     * @var string
     */
    protected $linkedinId = null;

    /**
     * Twitter id
     * @var string
     */
    protected $twitterId = null;

    /**
     * Foursquare id
     * @var string
     */
    protected $foursquareId = null;

    /**
     * Homepage url
     * @var string
     */
    protected $url = null;

    /**
     * Bio
     * @var string
     */
    protected $bio = null;

    /**
     * Avatar
     * @var string
     */
    protected $avatar = '/bundles/landmarxuser/img/avatars/default.png';

    /**
     * Slug
     * @var string
     */
    protected $slug;


    /**
     * Get id
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * Get name
     * @return string
     */
    public function getName()
    {
        return $this->firstname.' '.$this->lastname;
    }

    /**
     * Get the full name
     * @return string
     */
    public function getFullName()
    {
        return $this->getName();
    }

    /**
     * Set facebook id
     * @param string $facebookId
     * @return void
     */
    public function setFacebookId($facebookId)
    {
        $this->facebookId = $facebookId;
        $this->setUsername($facebookId);
        $this->salt = '';
    }

    /**
     * Get facebook id
     * @return string
     */
    public function getFacebookId()
    {
        return $this->facebookId;
    }

    /**
     * Set fb data
     * @param Array
     */
    public function setFBData($fbdata)
    {
        if (isset($fbdata['id'])) {
            $this->setFacebookId($fbdata['id']);
            $this->addRole('ROLE_FACEBOOK');
        }
        if (isset($fbdata['first_name'])) {
            $this->setFirstname($fbdata['first_name']);
        }
        if (isset($fbdata['last_name'])) {
            $this->setLastname($fbdata['last_name']);
        }
        if (isset($fbdata['email'])) {
            $this->setEmail($fbdata['email']);
        }
    }

    /**
     * @inheritdoc
     */
    public function setFirstname($firstName)
    {
        $this->firstname = $firstName;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @inheritdoc
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set google id
     * @param string $googleId
     * @return \Landmarx\Bundle\UserBundle\Model\User
     */
    public function setGoogleId($googleId)
    {
        $this->googleId = $googleId;
        return $this;
    }

    /**
     * Get google id
     * @return string
     */
    public function getGoogleId()
    {
        return $this->googleId;
    }

    /**
     * Set linkedin id
     * @param string $linkedinId
     * @return \Landmarx\Bundle\UserBundle\Model\User
     */
    public function setLinkedinId($linkedinId)
    {
        $this->linkedinId = $linkedinId;
        return $this;
    }

    /**
     * Get linkedin id
     * @return string
     */
    public function getLinkedinId()
    {
        return $this->linkedinId;
    }

    /**
     * Set twitter id
     * @param string $twitterId
     * @return \Landmarx\Bundle\UserBundle\Model\User
     */
    public function setTwitterId($twitterId)
    {
        $this->twitterId = $twitterId;
        return $this;
    }

    /**
     * Get twitter id
     * @return string
     */
    public function getTwitterId()
    {
        return $this->twitterId;
    }

    /**
     * Set foursquare id
     * @param string $foursquareId
     * @return \Landmarx\Bundle\UserBundle\Model\User
     */
    public function setFoursquareId($foursquareId)
    {
        $this->foursquareId = $foursquareId;
        return $this;
    }

    /**
     * Get foursquareId
     * @return string
     */
    public function getFoursquareId()
    {
        return $this->foursquareId;
    }

    /**
     * Set avatar
     * @param string $avatar
     * @return \Landmarx\Bundle\UserBundle\Model\User
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;
        return $this;
    }

    /**
     * Get avatar
     * @return string
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * Get homepage url
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set url
     * @param string $url
     * @return \Landmarx\Bundle\UserBundle\Model\User
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get bio
     * @return string
     */
    public function getBio()
    {
        return $this->bio;
    }

    /**
     * Set bio
     * @param string $bio
     * @return \Landmarx\Bundle\UserBundle\Model\User
     */
    public function setBio($bio)
    {
        $this->bio = $bio;

        return $this;
    }
    
    /**
     * Get slug
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set slug
     * @param string $slug
     * @return \Landmarx\Bundle\UserBundle\Model\User
     */
    public function setSlug($slug = null)
    {
        if (null == $slug) {
            $this->slug = str_replace(
                ' ',
                '-',
                $this->getName()
            );
        }

        return $this;
    }
}
