<?php

// OBSERVER pattern defines a subscription mechanism to notify the changes in one object to all its observer dependent
// objects. It is used when changes to the state of one object require changes to other objects; an object observes
// other objects and changes itself accordingly. The observer pattern lets an object subscribe to the state of another
// object, to observe the changes and to update itself accordingly.
// AN APPLICATION DOES NOT NECESSARILY HAVE TO HAVE A DESIGN PATTERN - SIMPLE CODE IS MORE IMPORTANT!

// Subscriber Interface
interface Subscriber {

    public function update($postID);
}

// Publisher
class HealthyMe {

    private $subscribers = array();
    private $post;

    public function registerSubscriber(Subscriber $subs) {
        $this->subscribers[] = $subs;
        echo "Subscriber added <br>";
    }

    public function notifySubscribers() {
        foreach ($this->subscribers as $subscriber) {
            $subscriber->update($this->post);
        }
    }

    public function publishPost($post) {
        $this->post = $post;
        $this->notifySubscribers();
    }
}

// Concrete subscriber
class FoodUpdateSubscribers implements Subscriber{
    
    public function update($postID) {
        echo "New post with ID $postID published <br>";
    }
}

$publisher = new HealthyMe();
$subscriber = new FoodUpdateSubscribers();

$publisher->registerSubscriber($subscriber);
$publisher->publishPost(12);