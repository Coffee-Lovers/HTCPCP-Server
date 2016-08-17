<?php
namespace CL\Queue\Implementations;

use \CL\Queue\QueueInterface;
use \PhpAmqpLib\Connection\AMQPStreamConnection;
use \PhpAmqpLib\Message\AMQPMessage;

/**
 * RabbitMQ implementation of task queu.
 */
class RabbitMQ implements QueueInterface
{
    protected $host;
    protected $port;
    protected $username;
    protected $password;
    protected $channel;
    protected $connection;

    /**
     * The constructor.
     * @param string $host     [description]
     * @param string $port     [description]
     * @param string $username [description]
     * @param string $password [description]
     */
    public function __construct(
        string $host,
        string $port,
        string $username,
        string $password
    ) {
        $this->host     = $host;
        $this->port     = $port;
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * Push task to the queue
     * @param  Task $m The task to push to queue.
     *
     * @return bool (if the push was successfull or not)
     */
    public function push(\CL\Queue\Task $m): bool
    {
        $this->connect();
        $data = "hello world";
        $msg = new AMQPMessage($data, array('delivery_mode' => 2));

        $this->channel->basic_publish($msg, '', 'task_queue');
        $this->tearDown();
        return true;
    }

    /**
     * Make connection to the rabbitMQ
     * @return boolean if connection succeeded
     */
    protected function connect()
    {
        $this->connection = new AMQPStreamConnection($this->host, $this->port, $this->username, $this->password);
        $this->channel = $this->connection->channel();
        $this->channel->queue_declare('task_queue', false, true, false, false);
    }

    /**
     * Close open connectoins.
     * @return void
     */
    protected function tearDown()
    {
        $this->channel->close();
        $this->connection->close();
    }
}
