<?php
Divide big class in subclasses
4
favorite
	

I have a very big class Foo that should be divided into FooBar, FooUtility, FooBench, FooBranch. Each of this "subclasses" should have different methods. So that if Foo has:

public function methodA();
public function methodB();
public function methodC();
public function methodZ();

Then I should be able to divide them as I want. For example:

FooBar:
public function __construct($param);
public function methodA();

FooUtility:
public function __construct($param);
public function methodB();

FooBench:
public function __construct($param);
public function methodZ();

FooBranch:
public function __construct($param);
public function methodC();

But I should be able to call methodB() and methodZ() from the same class Foo.

How should I manage this division? Interfaces? Abstract classes? Inheritance? How?
php oop
share
	
asked Jan 28 '12 at 14:10
Shoe
5111615
migrated from stackoverflow.com Jan 29 '12 at 3:13

This question came from our site for professional and enthusiast programmers.
locked by Jamal♦ Aug 9 '14 at 23:55

This question exists because it has historical significance, but it is not considered a good, on-topic question for this site, so please do not use it as evidence that you can ask similar questions here. This question and its answers are frozen and cannot be changed. More info: help center.
	
comments disabled on deleted / locked posts / reviews
1 Answer
active
oldest
votes
5 accepted
	

With Composition/Aggregation.

first define your interface for Foo collecting all the public methods it should expose from the components:

interface Foo
{
   public function methodA();
   public function methodB();
   …
}

You could also create interfaces for the components and extend the Foo interface from those, e.g.

interface Foo extends FooBar, FooUtility
{}

Note: it's not strictly necessary to have an interface collecting the other interfaces or to have an interface for Foo at all. However, since you should program against an interface and not a concrete implementation, it's cleaner.

Then implement that in your conrete Foo implementation:

class FooImplementation implements Foo
{
   public function __construct(FooBar $fooBar, FooUtility $fooUtility)
   {
       $this->fooBar = $fooBar;
       $this->fooUtility = $fooUtility;
   }
   public function methodA() 
   { 
       return $this->fooBar->methodA();
   } 
   public function methodB()
   {
       return $this->fooUtility->methodB();
   }
   …
}

Inject the various components through the ctor and then just have the methods on Foo delegate to the appropriate components.

You can use use a Factory or Builder to encapsulate creation of the complex Foo type. This will allow you to parametrize the subcomponents:

class FooFactory
{
    public function create($param1, $param2)
    {
        return new FooImplementation(
            new FooBar($param1), 
            new FooUtility($param2)
        );
    }
}

Note that Factory and Builder are creational patterns. They may control when and how objects are created, so if you want to reuse one of the components in subsequent calls to create, you may add logic to manage the component lifecycles in the factory/builder.
