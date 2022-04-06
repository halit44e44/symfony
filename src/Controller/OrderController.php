<?php

namespace App\Controller;

use App\Entity\Order;
use App\Repository\OrderRepository;
use Doctrine\Persistence\ManagerRegistry;
use JetBrains\PhpStorm\Pure;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Required;
use Symfony\Component\Validator\Validation;

class OrderController extends AbstractController
{
    /***
     * @var OrderRepository $orders
     */
    private OrderRepository $orders;

    /***
     * @var ManagerRegistry $doctrine
     */
    private ManagerRegistry $doctrine;

    #[Pure]
    public function __construct(ManagerRegistry $managerRegistry, OrderRepository $orderRepository)
    {
        $this->doctrine = $managerRegistry;
        $this->orders = $orderRepository;
    }

    #[Route('/getOrder/{orderCode}', name: 'getOrder', methods: 'GET')]
    public function getOrder($orderCode): Response
    {
        try {
            $array = [];
            $data = $this->orders->findOneByOrderCode($orderCode);
            $array['orderCode'] = $data->getOrderCode();
            $array['productId'] = $data->getProductId();
            $array['quantity'] = $data->getQuantity();
            $array['shippingDate'] = $data->getShippingDate();

            return $this->json([
                'code' => 200,
                'data' => $array
            ]);
        } catch (\Exception $exception) {
            return $this->json([
                'code' => 304,
                'message' => $exception->getMessage()
            ], 304);
        }
    }

    #[Route('/getAllOrders', name: 'getAllOrders', methods: 'GET')]
    public function getAllOrders(): Response
    {
        try {
            $array = [];
            foreach ($this->orders->findAll() as $key => $data) {
                $array[$key]['orderCode'] = $data->getOrderCode();
                $array[$key]['productId'] = $data->getProductId();
                $array[$key]['quantity'] = $data->getQuantity();
                $array[$key]['shippingDate'] = $data->getShippingDate();
            }
            return $this->json([
                'code' => 200,
                'data' => $array
            ]);
        } catch (\Exception $exception) {
            return $this->json([
                'code' => 304,
                'message' => $exception->getMessage()
            ], 304);
        }
    }

    /***
     * @param Request $request
     * @return Response
     */
    #[Route('/createOrder', name: 'createOrder', methods: 'POST')]
    public function createOrder(Request $request): Response
    {
        try {
            $data = $request->toArray();
            //Doğru bir validation mu bilmiyorum :/ Birazcık araştırdım bulamadım bende böyle karmaşık birşey oluşturdum. Yorum satırını kaldırırsanız çalışacaktır.
            /*
            $constraints = new Collection([
                'orderCode' => (new Required(new NotBlank())),
                'productId' => (new Required(new NotBlank())),
                'quantity' => (new Required(new NotBlank())),
                'address' => (new Required(new NotBlank()))
            ]);
            $validator = Validation::createValidator();
            $validation = $validator->validate($data, $constraints);
            if (count($validation) > 0) {
            foreach ($validation as $key => $vali) {
                $error[$key][$vali->getParameters()['{{ field }}']] = $vali->getMessage();
            }
                return $this->json($error, 400);
            }
            */

            $check = $this->orders->findOneByOrderCode($data['orderCode']);
            if ($check)
                return $this->json([
                    'code' => 409,
                    'message' => 'This orderCode is already registered'
                ], 409);

            $order = new Order();
            $order->setOrderCode($data['orderCode']);
            $order->setProductId($data['productId']);
            $order->setQuantity($data['quantity']);
            $order->setAddress($data['address']);

            $em = $this->doctrine->getManager();
            $em->persist($order);
            $em->flush();

            return $this->json([
                'code' => 201,
                'message' => 'Order Successfully Created',
                'orderCode' => $data['orderCode']
            ], 201);
        } catch (\Exception $exception) {
            return $this->json([
                'code' => 304,
                'message' => $exception->getMessage()
            ], 304);
        }
    }

    #[Route('/updateOrder/{orderCode}', name: 'updateOrder', methods: 'PUT')]
    public function updateOrder(Request $request, $orderCode): Response
    {
        try {
            $data = $request->toArray();
            $check = $this->orders->findOneByOrderCode($orderCode);
            if (!$check)
                return $this->json([
                    'code' => 204,
                    'message' => 'Order not found'
                ], 204);

            isset($data['quantity']) ? $check->setQuantity($data['quantity']) : null;
            isset($data['address']) ? $check->setAddress($data['address']) : null;

            $em = $this->doctrine->getManager();
            $em->flush();
            return $this->json([
                'code' => 200,
                'message' => 'Order is updated'
            ]);
        } catch (\Exception $exception) {
            return $this->json([
                'code' => 304,
                'message' => $exception->getMessage()
            ], 304);
        }
    }

    #[Route('/shippingUpdate/{orderCode}', name: 'shippingUpdate', methods: 'PATCH')]
    public function shippingUpdate(Request $request, $orderCode): Response
    {
        try {
            $data = $request->toArray();
            $check = $this->orders->findOneByOrderCode($orderCode);
            if (!$check)
                return $this->json([
                    'code' => 204,
                    'message' => 'Order not found'
                ], 204);

            $shippingDate = \DateTime::createFromFormat('Y-m-d', $data['shippingDate']);
            $check->setShippingDate($shippingDate);
            $em = $this->doctrine->getManager();
            $em->flush();
            return $this->json([
                'code' => 200,
                'message' => 'Order is shipping date updated'
            ]);
        } catch (\Exception $exception) {
            return $this->json([
                'code' => 304,
                'message' => $exception->getMessage()
            ], 304);
        }
    }

    #[Route('/shippingUpdate/{orderCode}', name: 'shippingUpdate', methods: 'PATCH')]
    public function deleteOrder($orderCode): Response
    {
        try {
            $check = $this->orders->findOneByOrderCode($orderCode);
            if (!$check)
                return $this->json([
                    'code' => 202,
                    'message' => 'Order not found'
                ], 202);

            $em = $this->doctrine->getManager();
            $em->remove($check);
            $em->flush();
            return $this->json([
                'code' => 200,
                'message' => 'Order is deleted'
            ]);
        } catch (\Exception $exception) {
            return $this->json([
                'code' => 304,
                'message' => $exception->getMessage()
            ], 304);
        }
    }
}
